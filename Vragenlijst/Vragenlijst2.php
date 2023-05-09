<?php

declare(strict_types=1);
class Product
{
  public function __construct(private string $naam, private string $beschrijving, private int $prijs)
  {
  }

  public function setName(string $naam): void
  {
    $this->naam = $naam;
  }
  public function getName(): string
  {
    return $this->naam;
  }
}



class Bankrekening
{
  private $Bank;
  private $bedragVanSaldo;
  public function __construct($Bank, $bedragVanSaldo)
  {
    $this->Bank = $Bank;
    $this->bedragVanSaldo = $bedragVanSaldo;
  }
  public function storten($bedrag)
  {
    $this->bedragVanSaldo += $bedrag;
  }

  public function opnemen($bedrag)
  {
    if ($this->bedragVanSaldo >= $bedrag) {
      $this->bedragVanSaldo -= $bedrag;
      return true;
    } else {
      return false;
    }
  }

  public function getSaldo()
  {
    return $this->bedragVanSaldo;
  }
}


$rekening = new Bankrekening("NL12ABCD3456789", 1000.0);
$rekening->storten(500.0);
$rekening->opnemen(200.0);
echo "Saldo: " . $rekening->getSaldo();
$rekening->opnemen(1500.0);
echo "Saldo: " . $rekening->getSaldo();




class BankrekeningPlus extends Bankrekening
{
  protected $Bank;
  protected $bedragVanSaldo;
  protected $limiet = -1000;
  protected $boetePercentage = 5;

  public function haalGeldAf($bedrag)
  {
    $nieuwSaldo = $this->bedragVanSaldo - $bedrag;
    if ($nieuwSaldo < $this->limiet) {
      return false;
    }
    $this->bedragVanSaldo = $nieuwSaldo;
    return true;
  }

  public function berekenBoeteBedrag()
  {
    $boeteBedrag = 0;
    if ($this->bedragVanSaldo < 0) {
      $boeteBedrag = abs($this->bedragVanSaldo) * $this->boetePercentage / 100;
    }
    return $boeteBedrag;
  }

  public function toonStatus()
  {
    $boeteBedrag = $this->berekenBoeteBedrag();
    $tijd = date('Y-m-d H:i:s');
    $OpDitMomentStatus = "Banknummer: {$this->Bank}\n";
    $OpDitMomentStatus .= "Saldo: €{$this->bedragVanSaldo}\n";
    $OpDitMomentStatus .= "Boete bedrag: €{$boeteBedrag}\n";
    $OpDitMomentStatus .= "Datum en tijd: {$tijd}\n";
    return $OpDitMomentStatus;
  }
}

$rekening = new BankrekeningPlus("NL12ABCD3456789", 1000.0);
$rekening->storten(500.0);
$rekening->opnemen(200.0);
echo $rekening->toonStatus();
$rekening->opnemen(1500.0);
echo $rekening->toonStatus();
