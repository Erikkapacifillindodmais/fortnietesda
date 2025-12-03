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

    print "\n=========== Opções ===========";
    print "\n= 1 - cadastrar cliente      =";
    print "\n= 2 - cadastrar conta        =";
    print "\n= 3 - depositar              =";
    print "\n= 4 - sacar                  =";
    print "\n= 5 - Consultar saldo        =";
    print "\n= 6 - Consultar extrato      =";
    print "\n= 7 - sair                   =";
    print "\n==============================\n";

 
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

    print("Conta criada com sucesso.$NumConta");

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

function sacar( array &$clientes){

    $cpf = readline("Informe o seu cpf:");

    $conta = readline("Informe o numero de conta:");

    $valorSaque = readline("Informe valor de saque:");

    if($clientes[$cpf]['contas'][$conta]['saldo'] + CHEQUE_ESPECIAL >= $valorSaque){

        $clientes[$cpf]['contas'][$conta]['saldo'] -= $valorSaque;

    }
}

$fim=false;

do{

   menu();

    $escolha = readline("escolha:");

        switch($escolha){

            case 1:

                CadastrarCliente($clientes);
                
                $fim = false;

            break;

            case 2:

                CadastrarConta($clientes);
            
            break;

            case 3:

                depositar($clientes);

            break;

            case 4:

                sacar($clientes);

            break;

            case 5:

                $cpf = readline("qual seu cpf");

                $numconta = readline("numero de conta");

                print ("seu saldo atual: ".$clientes[$cpf]['contas'][$numconta]['saldo']);

            break;

            case 6:

                $cpf = readline("qual seu cpf");

                $numconta = readline("numero de conta");

                print ("seu saldo atual: ".$clientes[$cpf]['contas'][$numconta]['extrato']);

            break;

            case 7:

                print("fechando programa");

                $fim = true;

            break;

            default:
                
                print("opção invalida");

            break;

        }

    }while($fim==false);