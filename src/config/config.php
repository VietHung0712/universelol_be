<?php
class Config
{
    private $host = "localhost";
    private $user = "root";
    private $password = "";
    private $dbname = "leagueoflegends";
    private $connect;
    private $assetsURL = "https://raw.githubusercontent.com/VietHung0712/AssetsLOL/refs/heads/main";

    public function connect()
    {
        $this->connect = new mysqli($this->host, $this->user, $this->password, $this->dbname);
        return $this->connect;
    }
}
