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
    <script src="/assets/script.js"></script>
    

</head>

<body>

    <header>
        <div class="header">
            Ewelina Ziobro
        </div>
    </header>

    <main>
        <a href="/">&lt; Powrót do strony głównej</a>
    
        <h1>Klient: <?= $customer['name'] ?></h1>
        
    
        <h2>Wszystkie faktury</h2>
        
        <form id="invoices-search-form" class="search-form" method="GET" onsubmit="filterInvoices();">
            
            <input type="text" name="number" placeholder="Numer faktury" value="<?= isset($_GET['iNumber']) ? $_GET['iNumber'] : '' ?>"/>
            <input type="text" name="date" placeholder="Data wystawienia" value="<?= isset($_GET['iDate']) ? $_GET['iDate'] : '' ?>" />
            <input type="text" name="due_date" placeholder="Data płatności" value="<?= isset($_GET['iDueDate']) ? $_GET['iDueDate'] : '' ?>" />
            <input type="text" name="gross_total" placeholder="Suma do zapłaty" value="<?= isset($_GET['iGrossTotal']) ? $_GET['iGrossTotal'] : '' ?>" />
            
            <input id="invoices-search-btn" type="submit" value="Szukaj" />
            
        </form>
        
        <?php if($invoices) : ?>
        
        <br/>
        
        <table class="invoices-table">
            <thead>
              <tr>
                  <td>Lp.</td>
                  <td class="pointer" onclick='sortInvBy("number")'>Numer faktury <span>&uarr;</span><span>&darr;</span></td>
                  <td class="pointer" onclick='sortInvBy("date")'>Wstawiono dnia <span>&uarr;</span><span>&darr;</span></td>
                  <td class="pointer" onclick='sortInvBy("due_date")'>Płatność do <span>&uarr;</span><span>&darr;</span></td>
                  <td class="pointer" onclick="sortInvBy('gross_total')">Suma do zapłaty (PLN) <span>&uarr;</span><span>&darr;</span></td>
                  <td>Status</td>
              </tr>
            </thead>
            <tbody>
            <?php 
                $i=1;
                $invoices_gross_total = 0;
                foreach($invoices AS $invoice) :
            ?>
              <tr>
                  <td><?= $i ?></td>
                  <td><?= $invoice['number'] ?></td>
                  <td><?= $invoice['date'] ?></td>
                  <td><?= $invoice['due_date'] ?></td>
                  <td><?= number_format($invoice['gross_total'],2,',', ' ') ?></td>
                  <td><?php
                    if(isset($invoice['invoice_id'])) {
                        echo '<span class="payment-ok">Opłacono</span>';
                    } else {
                        if(strtotime($invoice['due_date']) > strtotime("now")){
                           echo '<span class="payment-error">Nieopłacono</span>';  
                        } else {
                            echo '<span>Oczekuje na opłacenie</span>'; 
                        }
                    }
                  ?></td>
              </tr>
              <?php 
                $i++;
                $invoices_gross_total +=$invoice['gross_total'];
                endforeach; 
              ?>
            </tbody>
        </table>
        
        <?php else : ?>
        
        <p>Nie znaleziono faktur</p>
        
        <?php endif; ?>
        
        <br/>
        
        <h2>Wpłaty klienta:</h2>
        
        <?php if($payments) : ?>
        
        <table>
            <thead>
              <tr>
                  <td>Lp.</td>
                  <td class="pointer" onclick='sortPayBy("payment_title")'>Tytuł wpłaty <span>&uarr;</span><span>&darr;</span></td>
                  <td class="pointer" onclick='sortPayBy("amount")'>Kwota <span>&uarr;</span><span>&darr;</span></td>
                  <td class="pointer" onclick='sortPayBy("bank_number_for_payment")'>Numer konta bankowego wpłaty <span>&uarr;</span><span>&darr;</span></td>
                  <td class="pointer" onclick='sortPayBy("payment_date")'>Data wpłaty <span>&uarr;</span><span>&darr;</span></td>
              </tr>
            </thead>
            <tbody>
            <?php 
                $i=1;
                $payments_total = 0;
                foreach($payments AS $payment) :
            ?>
              <tr>
                  <td><?= $i ?></td>
                  <td><?= $payment['payment_title'] ?></td>
                  <td><?= number_format($payment['amount'],2,',', ' ') ?></td>
                  <td><?= $payment['bank_number_for_payment'] ?></td>
                  <td><?= $payment['payment_date'] ?></td>
                  
              </tr>
              <?php 
                $i++;
                $payments_total += $payment['amount'];
                endforeach; 
              ?>
            </tbody>
        </table>
        
        <?php else : ?>
        
        <p>Klient nie posiada wpłat.</p>
        
        <?php endif; ?>
        
        <br/>
        
        <h2>Status konta klienta: </h2>
        <div class="payment-status">
        <?php 
            $sum = ($payments ? $payments_total : 0) - ($invoices ? $invoices_gross_total : 0);
            if($sum == 0) {
                echo '<span class="payment-ok">Opłacono wszystkie faktury</span>';
            } else if($sum > 0){
                echo '<span class="payment-ok">Nadpłata: ' . number_format($sum,2,',', ' ') . ' PLN</span>';
            } else {
                echo '<span class="payment-error">Niedopłata: ' . number_format($sum,2,',', ' ') . ' PLN</span>';
            }
        ?>
        </div>

    </main>
    
    <footer>
    </footer>
    
</body>
