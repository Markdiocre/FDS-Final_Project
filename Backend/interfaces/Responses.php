<?php
interface ResponseInterfacePHPTemp{
    public function responsePayload($payload, $remarks, $message, $code);
    public function notFound();
    public function getIDFromToken();
}