<?php

namespace App;

class BladeFormatter
{
    private $indentation;
    private $indentChar;
    private $newLineChar;

    public function __construct($indentation = 4, $indentChar = " ", $newLineChar = "\n")
    {
        $this->indentation = $indentation;
        $this->indentChar = $indentChar;
        $this->newLineChar = $newLineChar;
    }

    public function format($bladeCode)
    {
        $lines = explode($this->newLineChar, $bladeCode);
        $indentLevel = 0;
        $formattedLines = [];
        foreach ($lines as $line) {
            // Handle Blade directives
            if (preg_match("/^\s*@/", $line)) {
                $formattedLines[] = $line;
                continue;
            }

            // Handle HTML tags
            if (preg_match("/<\/?[a-z][^>]*>/i", $line)) {
                // Check if the line contains an opening and closing tag on the same line
                if (preg_match("/^\s*<[^>]+>.*<\/[^>]+>\s*$/", $line)) {
                    $formattedLines[] = $line;
                } else {
                    // Split the line into opening and closing tags and content
                    $parts = preg_split("/(<[^>]+>)/", $line, -1, PREG_SPLIT_DELIM_CAPTURE);
                    foreach ($parts as $part) {
                        if (preg_match("/<\/?[a-z][^>]*>/i", $part)) {
                            $formattedLines[] = str_repeat($this->indentChar, $indentLevel) . $part;
                            if (preg_match("/^\s*<[^>]+[^\/]>\s*$/", $part)) {
                                $indentLevel += $this->indentation;
                            } else if (preg_match("/^\s*<\/[^>]+>\s*$/", $part)) {
                                $indentLevel -= $this->indentation;
                            }
                        } else {
                            $formattedLines[] = str_repeat($this->indentChar, $indentLevel) . $part;
                        }
                    }
                }
            } else {
                $formattedLines[] = str_repeat($this->indentChar, $indentLevel) . $line;
            }
        }
        return implode($this->newLineChar, $formattedLines);
    }
}

