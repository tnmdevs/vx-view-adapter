<?php

namespace TNM\VXView\Services;

class UniqueIDGenerator
{
    private int $length;
    private string $prefix;
    private bool $alphanumeric;

    public function __construct(int $length = 18, string $prefix = '', bool $alphanumeric = true)
    {
        $this->length = $length;
        $this->prefix = $prefix;
        $this->alphanumeric = $alphanumeric;
    }

    public function generate()
    {
        return substr(sprintf("%s%s%s", $this->prefix, $this->getTime(), $this->getSuffix()), 0, $this->length);
    }

    private function getTime(): int
    {
        return (int)round(microtime(true) * 1000);
    }

    private function getSuffix(): string
    {
        return $this->generateKey($this->length - 13 - strlen($this->prefix));
    }

    private function generateKey(int $length = 10): string
    {
        $characters = $this->alphanumeric ? '23456789ABCDEFGHJKLMNPQRSTUVWXYZ' : '0123456789';

        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
