<?php

const CHEQUE_ESPECIAL = 500;

$clientes = [];

function CadastrarCliente(&$clientes): bool {


    $nome = readline('informe se nome: ');

    $cpf = readline ('informe seu cpf: ');

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

    $cpf = readline("Informe seu CPF: ");

    if (!isset($clientes[$cpf])){

        print("cliente não possui cadastro");

        return false;

    }

    $NumConta = rand(10000,100000);

    $clientes[$cpf]['contas'][$NumConta] = [

        'saldo'           => 0,
        'cheque especial' => CHEQUE_ESPECIAL,
        'extrato'         => []

    ];

    print("Conta criada com sucesso. $NumConta");

}

function depositar(array &$clientes){

    $cpf = readline("Informe seu CPF novamente: ");

    if(!isset($clientes[$cpf])){

        print("Este cpf não está cadastrado.");

        return false;

    }

    $Numconta = readline("informe numero de conta: ");

    if(!isset($clientes[$cpf]['contas'][$Numconta])){

        print("Esta conta não está cadastrada.");

        return false;

    }


    $ValorDeposito = (float) readline("Informe valor do deposito: ");

    if ($ValorDeposito <= 0){
        print ("Valor de deposito invalido.");

        return false;
    }

    $clientes[$cpf]['contas'][$Numconta]['saldo'] += $ValorDeposito;

    $datahora = date("d/m/Y H : i");
    $clientes[$cpf]['contas'][$Numconta]['extrato'][] = "Deposito de R$ $ValorDeposito em $datahora";

    print "Deposito realizado com sucesso";

    return true;

}

function sacar( array &$clientes){

    $cpf = readline("Informe o seu cpf:");

    if(!isset($clientes[$cpf])){

        print("Este cpf não está cadastrado.");

        return false;

    }

    $Numconta = readline("Informe o numero de conta:");

    if(!isset($clientes[$cpf]['contas'][$Numconta])){

        print("Esta conta não está cadastrada.");

        return false;

    }

    $valorSaque = readline("Informe valor de saque:");

    if($clientes[$cpf]['contas'][$Numconta]['saldo'] + CHEQUE_ESPECIAL >= $valorSaque){

        $clientes[$cpf]['contas'][$Numconta]['saldo'] -= $valorSaque;

    }else{

        print("Valor de saque invalido.");

        return false;

    }


    $datahora = date("d/m/Y H : i");
    $clientes[$cpf]['contas'][$Numconta]['extrato'][] = "Saque de R$ $valorSaque em $datahora";

    print "Saque realizado com sucesso";
}

function MostrarSaldo(&$clientes){

    $cpf = readline("qual seu cpf: ");

    if(!isset($clientes[$cpf])){

        print("Este cpf não está cadastrado.");

        return false;

    }

    $numconta = readline("Informe o numero de conta: ");

    if(!isset($clientes[$cpf]['contas'][$numconta])){

        print("Esta conta não está cadastrada.");

        return false;

    }

    print ("seu saldo atual: ".$clientes[$cpf]['contas'][$numconta]['saldo']);

}

function MostrarExtrato(&$clientes){

    $cpf = readline("qual seu cpf: ");

    if(!isset($clientes[$cpf])){

        print("Este cpf não está cadastrado.");

        return false;

    }

    $numconta = readline("Informe o numero de conta: ");

    if(!isset($clientes[$cpf]['contas'][$numconta])){

        print("Esta conta não está cadastrada.");

        return false;

    }

    foreach ($clientes[$cpf]['contas'][$numconta]['extrato'] as $item_extrato) {

        print $item_extrato . "\n";

    }

    // $quantidade_intens = count($clientes[$cpf]['contas'][$numconta]['extrato']);

    // for ($i=0; $i < $quantidade_intens; $i++) { 
    //     print $clientes[$cpf]['contas'][$numconta]['extrato'][$i] . "\n";
    // }

}

$fim=false;

do{

   menu();

    $escolha = readline("escolha:");

        switch($escolha){

            case 1:

                CadastrarCliente($clientes);

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

                MostrarSaldo($clientes);

            break;

            case 6:

                MostrarExtrato($clientes);


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