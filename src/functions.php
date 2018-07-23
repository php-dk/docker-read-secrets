<?php
use phpdk\dockerReadSecrets\Reader;

function pdk_secret_read(string $name, $defValue = null, string $dir = Reader::DEFAULT_DIR)
{
    return Reader::new($dir)->getScalar($name, $defValue);
}

function pdk_secret(string $name, $defValue = null, string $dir = Reader::DEFAULT_DIR): \phpdk\dockerReadSecrets\Secret
{
    return Reader::new($dir)->get($name, $defValue);
}
