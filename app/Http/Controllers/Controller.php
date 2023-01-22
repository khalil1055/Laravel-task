<?php

namespace App\Http\Controllers;

use App\Http\Requests\CountAllExceptFiveRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function countAllExceptFive(Request $request)
    {
        $start = $request->get('start');
        $end = $request->get('end');

        $start_res = $this->countFiveToN(abs($start));
        $end_res = $this->countFiveToN(abs($end));

        return response(["result" =>  abs($end) - abs($start) -  ($end_res - $start_res) + ($this->numberHasFive($start) && $this->numberHasFive($end) ? 0 : 1) ], 200);
    }

    /**
     * get count of number with five digit from 0 to n
     *
     * @param $n
     * @return int
     */
    private function countFiveToN($n){
        $res = 0;
        $N = $n;

        $pw = 1;
        while($n >= $pw) $pw *= 10;

        while($pw > 1){

            $pw = intval($pw/ 10);

            $digit = intval($n / $pw);

            $x = $this->getFiveInTens($pw);

            if($pw == 1){
                if($digit >= 5) $res++;
            }elseif ($digit == 5){
                $res += $x * 5;
                $n %= $pw;
                $res += $n+1;
                break;
            }elseif ($digit > 5){
                $res += $x * ($digit - 1) + $pw;
            }else {
                $res += $x * $digit;
            }

            $n%=$pw;
        }

        return $res;
    }

    /**
     * get count of fives in numbers  10^ (10 , 100 , 1000 ...)
     * @param $n
     * @return int
     */
    private function getFiveInTens($n){
        if($n < 5) return 0;
        else if($n <= 10) return 1;

        return $this->getFiveInTens(intval($n/10)) * 9 + intval($n/10);
    }


    /**
     * check if the number has five digit
     * @param $n
     * @return bool
     */
    private function numberHasFive($n){
        while($n){
            if($n % 10 == 5) return true;
            $n = intval($n / 10);
        }
        return false;
    }





    /**
     * @desc convert capital characters to their sequential number
     * @param Request $request
     *
     */
    public function alphaToInt(Request $request)
    {
        $request->validate(['string' => 'required']);
        $jlpha = $request->get('string');
        $jns = 0;
        for ($j = 0, $i = strlen($jlpha) - 1; $i >= 0; $i--, $j++) {
            $jns += pow(26, $j) * (ord($jlpha[$i]) - ord('A') + 1);
        }

        return response(['result' => $jns]);
    }




    /**
     *
     * @param Request $request
     */
    public function minSteps(Request $request)
    {

        $request->validate(['N' => 'required|integer' , 'Q' => 'required']);
        $n = $request->get('N');
        $q = $request->get('Q');


        $dp = array_fill(0, 10000, 1000000);
        $dp[0] = 0;

        // bottom-up dynamic programming
        for ($i = 1; $i < sizeof($dp); $i++) {
            for ($j = 2; $j * $j <= $i; $j++) {

                if ($i % $j == 0) {

                    $k = $i / $j;
                    $dp[$i] = min($dp[$i], 1 + $dp[max($j, $k)]);
                }
            }

            $dp[$i] = min($dp[$i], 1 + $dp[$i - 1]);
        }

        $result = [];
        for ($i = 0; $i < $n; $i++) {
            $result[] = $dp[$q[$i]];
        }

        return response($result,200);
    }

}
