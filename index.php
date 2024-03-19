<?php
function reverseWordOrder($str)
{
    // Разделить строку на слова с учетом пунктуации
    preg_match_all('/\b\w+\b|\W+/u', $str, $matches);
    $words = $matches[0];

    foreach ($words as &$word) {
        if (preg_match('/^\p{L}+$/u', $word)) {
            $word = reverseWord($word);
        }
    }

    return implode('', $words);
}

// Функция для обратного порядка букв в слове с сохранением регистра
function reverseWord($word)
{
    preg_match_all('/./u', $word, $wordChars);
    $chars = $wordChars[0];

    $reversedChars = [];
    foreach ($chars as $char) {
        if (mb_strtolower($char) === $char) {
            $reversedChars[] = mb_strtolower(array_pop($chars));
        } else {
            $reversedChars[] = mb_strtoupper(array_pop($chars));
        }
    }

    return implode('', $reversedChars);
}

class ReverseLettersInWordsTest
{
    public function run()
    {
        $this->assertEquals(reverseWordOrder("Cat"), "Tac");
        $this->assertEquals(reverseWordOrder("Мышь"), "Ьшым");
        $this->assertEquals(reverseWordOrder("houSe"), "esuOh");
        $this->assertEquals(reverseWordOrder("домИК"), "кимОД");
        $this->assertEquals(reverseWordOrder("elEpHant"), "tnAhPele");
        $this->assertEquals(reverseWordOrder("cat,"), "tac,");
        $this->assertEquals(reverseWordOrder("Зима:"), "Амиз:");
        $this->assertEquals(reverseWordOrder("is 'cold' now"), "si 'dloc' won");
        $this->assertEquals(reverseWordOrder("это «Так» \"просто\""), "отэ «Кат» \"отсорп\"");
        $this->assertEquals(reverseWordOrder("third-part"), "driht-trap");
        $this->assertEquals(reverseWordOrder("can`t"), "nac`t");
    }

    private function assertEquals($actual, $expected)
    {
        if ($actual !== $expected) {
            throw new Exception("Assertion failed: Expected '$expected', but got '$actual'");
        } else {
            echo 'TEST DONE!' . '<br>';
        }
    }
}

$test = new ReverseLettersInWordsTest();
$test->run();
