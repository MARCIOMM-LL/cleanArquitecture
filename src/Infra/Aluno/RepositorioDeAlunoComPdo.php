<?php

namespace Alura\Arquitetura\Infra\Aluno;

use Alura\Arquitetura\Dominio\Aluno\Aluno;
use Alura\Arquitetura\Dominio\Aluno\RepositorioDeAluno;
use Alura\Arquitetura\Dominio\Aluno\Telefone;
use Alura\Arquitetura\Dominio\CPF;

class RepositorioDeAlunoComPdo implements RepositorioDeAluno
{
    private \PDO $conexao;

    #Importação da classe PDO
    public function __construct(\PDO $conexao)
    {
        $this->conexao = $conexao;
    }

    public function adicionar(Aluno $aluno): void
    {
        $sql = 'INSERT INTO alunos VALUES (:cpf, :nome, :email);';
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue('cpf', $aluno->cpf());
        $stmt->bindValue('nome', $aluno->nome());
        $stmt->bindValue('email', $aluno->email());
        $stmt->execute();

        $sql = 'INSERT INTO telefones VALUES (:ddd, :numero, :cpf_aluno)';
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue('cpf_aluno', $aluno->cpf());

        #Anotações são etiquetas com informações relevantes dentro de um bloco
        #de comentário no qual você escreve metadados sobre alguma classe, método 
        #ou mesmo atributos de classe para que se possa, em tempo de execução resgatar 
        #esses metadados e trabalhá-los de acordo com a sua necessidade.
        /** @var Telefone $telefone */
        foreach ($aluno->telefones() as $telefone) {
            $stmt->bindValue('ddd', $telefone->ddd());
            $stmt->bindValue('numero', $telefone->numero());
            $stmt->execute();
        }
    }

    public function buscarPorCpf(CPF $cpf): Aluno
    {
        $sql = 'SELECT cpf, nome, email, ddd, numero as numero_telefone
                FROM alunos
                LEFT JOIN telefones ON telefones.cpf_aluno = alunos.cpf
                WHERE alunos.cpf = ?;';

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, (string) $cpf);
        $stmt->execute();

        $dadosAluno = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        if (count($dadosAluno) === 0) {
            throw new \Exception($cpf);
        }

        return $this->mapearAluno($dadosAluno);
    }

    private function mapearAluno(array $dadosAluno): Aluno
    {
        $primeiraLinha = $dadosAluno[0];
        $aluno = Aluno::comCpfEmailNome($primeiraLinha['cpf'], 
                 $primeiraLinha['nome'], $primeiraLinha['email']);

        $telefones = array_filter($dadosAluno, fn ($linha) => $linha['ddd'] !== 
                                  null && $linha['numero_telefone'] !== null);

        foreach ($telefones as $linha) {
            $aluno->adicionarTelefone($linha['ddd'], $linha['numero_telefone']);
        }

        return $aluno;
    }

    public function buscarTodos(): array
    {
        $sql = 'SELECT cpf, nome, email, ddd, numero as numero_telefone
                FROM alunos
                LEFT JOIN telefones ON telefones.cpf_aluno = alunos.cpf;';

        $stmt = $this->conexao->query($sql);

        $listaDadosAlunos = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        $alunos = [];

        foreach ($listaDadosAlunos as $dadosAluno) {
            if (!array_key_exists($dadosAluno['cpf'], $alunos)) {
                $alunos[$dadosAluno['cpf']] = Aluno::comCpfEmailNome(
                    $dadosAluno['cpf'],
                    $dadosAluno['nome'],
                    $dadosAluno['email']
                );
            }

            $alunos[$dadosAluno['cpf']]->adicionarTelefone($dadosAluno['ddd'], $dadosAluno['numero_telefone']);
        }

        return array_values($alunos);
    }
}