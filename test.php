<?php
            $minutes = 10;
            $debitCents = .08;
            $callTolls = 0;
              $usedMonthlyMinutes = 5;
              $minutes = 10;
              $change = $usedMonthlyMinutes - $minutes;
              $percentOfDebit = 1.0;
              //when total goes below 0, only change the amount that went below 0
              if ($usedMonthlyMinutes > 0 && $change < 0) {
                //$change =  -5;
                //$usedMonthlyMinutes =  10;
                $positive = abs($change);

                $set1 = $usedMonthlyMinutes + $positive;
                $percentOfDebit = $set1 / $positive;
                $percentOfDebit = (float)(sprintf(".%d", $percentOfDebit));
                $centsToCharge = $debitCents * $percentOfDebit;
                $callTolls = $callTolls + $centsToCharge;
              } elseif ($usedMonthlyMinutes < 0) { 
                $callTolls = $callTolls + $debitCents;
              } elseif ($usedMonthlyMinutes > 0 && $change >= 0) {
                $callTolls = $callTolls;
              }
              $usedMonthlyMinutes = $usedMonthlyMinutes - $minutes;
              print($usedMonthlyMinutes.PHP_EOL);
              print($callTolls.PHP_EOL);