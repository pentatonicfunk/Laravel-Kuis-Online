<?php


class UserJawabLembar extends UserJawabLembarBase
{
    //put custom code here... look in the base class for generated relations..

    public function calcScore()
    {
        $jawabanBenar  = 0;
        $jawabanSalah  = 0;
        $jawabanKosong = 0;

        foreach (UserJawab::whereRaw('user_jawab_lembar_id = ? ', array($this->id))->get() as $userJawab) {
            if (!$userJawab->jawaban_id)
                $jawabanKosong++;
            else {
                //get jawaban benar of soal
                $jawabanBenars = $userJawab->soal->jawaban->filter(function ($jawaban) {
                    if ($jawaban->is_benar) {
                        return $jawaban;
                    }
                });

                $isBenar = false;
                foreach ($jawabanBenars as $jawabanBenarFromSoal) {
                    if ($userJawab->jawaban_id == $jawabanBenarFromSoal->id) {
                        $isBenar = true;
                    }
                }

                if ($isBenar)
                    $jawabanBenar++;
                else
                    $jawabanSalah++;
            }
        }

        $this->score = (4 * $jawabanBenar) - (2 * $jawabanSalah) - $jawabanKosong + (int)$this->lembar->batas_waktu;
    }

}