<?php
class sinhvien_ett {
    public $hoten;
    public $mssv;
    public $gioitinh;

    public function __construct($Hoten, $Mssv, $Gioitinh)
    {
        $this->hoten = $Hoten;
        $this->mssv = $Mssv;
        $this->gioitinh = $Gioitinh;
    }
}
?>