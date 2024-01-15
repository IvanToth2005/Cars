<?php
    function getCsvData($fileName){

        if (!file_exists($fileName)){
            echo "$filename nem található";
            return false;
        }
        $csvFile = fopen($fileName, 'r');
        $lines = [];
        while (! feof($csvFile)) {
            $line = fgetcsv($csvFile);
            $lines[] = $line;
        }
        fclose($csvFile);
        return $lines;
    }

    /* 
    function getMakers($csvData) {
        $header = $csvData[0];
        $idxMaker = array_search('make', $header);
        
        if (!empty($csvData)) {
            $maker = '';
            $model = '';
            $makers = [];
            $isHeader = true;
            foreach($csvData as $idx => $data) {
                if(!is_array($data)){
                    continue;
                }
                
                if ($isHeader) {
                    $isHeader = false;
                    continue;
                }
                if ($maker != $data[$idxMaker]){
                    $maker = $data[$idxMaker];
                    $makers[] = $maker;
                }              
            } 
            return $makers;
    }
    
    }*/

    function getMakers($csvData)
    {
        $idxMaker = array_search('make', $csvData[0]);
        $makers = [];
        $isHeader = true;
        foreach ($csvData as $data) {
            if (!is_array($data)) {
                continue;
            }
            if ($isHeader) {
                $isHeader = false;
                continue;
            }

            $maker = $data[$idxMaker];
            if (!in_array($maker, $makers)) {
                $makers[] = $maker;
            }
        }

        return $makers;
    }


    function getModels($csvData)
    {
        $idxModel = array_search('model', $csvData[0]);
        $models = [];
        $isHeader = true;
        foreach ($csvData as $data) {
            if (!is_array($data)) {
                continue;
            }
            if ($isHeader) {
                $isHeader = false;
                continue;
            }
            $model = $data[$idxModel];
            if (!in_array($model, $models)) {
                $models[] = $model;}
        }

        return $models;
    }


?>