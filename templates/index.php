<?php
    
?>

<!DOCTYPE html>
<html lang="pl">
<head>

    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    
    <link rel="icon" href="https://ewelinaziobro.pl/logo.png">
    
    <title>Aplikacja klienta</title>

	<meta name="description" content="">
	<meta name="keywords" content="">

    <link rel="stylesheet" href="/templates/style.css" type="text/css">
    

</head>

<body>

    <header>
        <div class="header">
            Ewelina Ziobro
        </div>
    </header>

    <main>
    
        <h1>Aplikacja do faktur</h1>
        
        <h2>Klienci</h2>
        
        <table>
            <thead>
              <tr>
                  <td>Lp.</td>
                  <td>Imię i nazwisko</td>
                  <td>Numer rachunku</td>
                  <td>NIP</td>
              </tr>
            </thead>
            <tbody>
            <?php 
            
                $i=1;
                foreach($customers AS $customer) : ?>
              <tr>
                  <td><?= $i ?></td>
                  <td><a href="/index.php?customerId=<?= $customer['id'] ?>"><?= $customer['name'] ?></a></td>
                  <td><?= $customer['bank_account_number'] ?></td>
                  <td><?= $customer['NIP'] ?></td>
              </tr>
              <?php 
                $i++;
                endforeach; 
              ?>
            </tbody>
        </table>


    </main>
    
    <footer>
    </footer>
    
</body>
