<?php
    function PPL(){
        return ["PPL", "PPL", "PPL"];
    }

    function FullBody(){
        return ["Fullbody", "ful", "ful"];
    }

    function BroSplit(){
        return ["bro", "bro", "bro"];
    }

    function ShowPlan(array $CVIKY_PLAN){

        foreach ($CVIKY_PLAN as $cvik) {
            echo $cvik . "<br>";
        }
    }

