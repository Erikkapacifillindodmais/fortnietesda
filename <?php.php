<?php

const CHEQUE_ESPECIAL = 500;

$clientes = [];

function CadastrarCliente(&$clientes): bool {


    $nome = readline('informe se nome:');

    $cpf = readline ('informe seu cpf');

    if(isset($clientes[$cpf])) {

        print('Esse cpf já está cadastrado.');

        return false;

    }

    $clientes[$cpf] = [
        
        'nome'   => $nome,
        'cpf'    => $cpf,
        'contas' => []

    ];

    return true;

}

function menu(){

    print "=========== Opções ===========";
    print "= 1 - cadastrar cliente      =";
    print "= 2 - cadastrar conta        =";
    print "= 3 - depositar              =";
    print "= 4 - sacar                  =";
    print "= 5 - Consultar saldo        =";
    print "= 6 - Consultar extrato      =";
    print "= 7 - sair                   =";
    print "==============================";

}

function CadastrarConta( array &$clientes){

    $cpf = readline("Informe seu CPF:");

    if (!isset($clientes[$cpf])){

        print("cliente não possui cadastro");

        return;

    }

    $NumConta = rand(10000,100000);

    $clientes[$cpf]['contas'][$NumConta] = [

        'saldo'           => 0,
        'cheque especial' => CHEQUE_ESPECIAL,
        'extrato'         => []

    ];

    print("Conta criada com sucesso.");

}

function depositar(array &$clientes){

    $cpf =readline("Informe seu CPF novamnete.");

    $NumConta = readline("informe numero de conta");

    $ValorDeposito = (float) readline("Informe valor do deposito.");

    if ($ValorDeposito <= 0){
        print ("Valor de deposito invalido.");

        return false;
    }

    $clientes[$cpf]['conta'][$NumConta]['saldo'] += $ValorDeposito;

    $datahora = date("d/m/Y H : i");
    $clientes[$cpf]['contas'][$NumConta]['extrato'][] = "Deposito de R$ $ValorDeposito em $datahora";

    print "Deposito realizado com sucesso";

    return true;

}

function Banco(){
    menu();
    
}
CadastrarCliente($clientes);
CadastrarConta($clientes);

print_r($clientes);

depositar($clientes);
print_r($clientes);