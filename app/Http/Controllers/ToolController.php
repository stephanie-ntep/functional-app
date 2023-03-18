<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Html2Text\Html2Text;

class ToolController extends Controller
{
    public function CalculateAndGetDensity(Request $request) {
        // Test the parameter is set.
        $html = new Html2Text($request->keywordInput); // Setup the html2text obj.
        $text = strtolower($html->getText()); // Execute the getText() function and convert all text to lower case to prevent work duplication
        $totalWordCount = str_word_count($text); // Get the total count of words in the text string
        $wordsAndOccurrence  = array_count_values(str_word_count($text, 1)); // Get each word and the occurrence count as key value array
        arsort($wordsAndOccurrence); // Sort into descending order of the array value (occurrence)

        $keywordDensityArray = [];
        // Build the array
        foreach ($wordsAndOccurrence as $key => $value) {
            $keywordDensityArray[] = ["keyword" => $key, // keyword
                "count" => $value, // word occurrences
                "density" => round(($value / $totalWordCount) * 100,2)]; // Round density to two decimal places.
        }

        if ($keywordDensityArray==[]) {
            return "Please check your input !";
        }

        return $keywordDensityArray;
    }

    public function CalculatePlagiarism(Request $request) {
        $textMain = strtolower($request->mainInput); // Execute the getText() function and convert all text to lower case to prevent work duplication
        $textCInput = strtolower($request->cInput);

        $cleanCharMain = count_chars( $textMain, 3);
        $cleanCharCInput = count_chars( $textCInput, 3);
        
        $splitMain = str_split($cleanCharMain);
        $splitCInput = str_split($cleanCharCInput);

        $res    = array_merge($splitMain, $splitCInput);
        $count  = array_count_values($res);
        
        $c = 0;
        foreach ($count as $key => $value) {
            if ($value == 2) {
                $c += 1;
            }
        }

        $result = $c / count(str_split($request->mainInput)) * 100 ;
        return round($result);
    }
}
