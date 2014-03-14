<?php


class Soal extends SoalBase
{
    //put custom code here... look in the base class for generated relations..

    public function getMaxPoint()
    {
        $maxPoint = 0;
        foreach ($this->jawaban as $jawaban)
            if ($jawaban->poin > $maxPoint)
                $maxPoint = $jawaban->poin;

        return $maxPoint;
    }

}