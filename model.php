<?php

class Model
{
    /**
     * @param array $config
     */
    public function __construct($config)
    {
        $this->pdo = $this->getPDO($config['db_config']);
    }

    /**
     * @param array $config
     * @return PDO
     */
    private function getPDO($config): PDO
    {
        $dsn = 'mysql:';
        $dsn .= 'host=' . $config['host'] . ';';
        $dsn .= 'port=' . $config['port'] . ';';
        $dsn .= 'dbname=' . $config['dbname'] . ';';
        $dsn .= 'charset=' . $config['charset'] . ';';
        $opt = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];
        $pdo = new PDO($dsn, $config['user'], $config['pass'], $opt);
        return $pdo;
    }

    /**
     * @param int $length
     * @return string
     */
    public function createAlias(int $length = ALIAS_LENGTH): string
    {
        $count = 0;
        $alias = '';
        $az = 'abcdefghijklmnopqrstuvwxyz0123456789';
        $ar_az = str_split($az);
        while ($count++ < $length) {
            $key = array_rand($ar_az);
            $alias .= $ar_az[$key];
        }
        return $alias;
    }

    /**
     * @param array
     * @return string
     */
    function createUrl(array $segments): string
    {
        return 'http://' . HOST_NAME . '/' . implode('/', $segments);
    }

    /**
     * @param string $link
     * @return array
     */
    public function getAliasByLink(string $link): array
    {
        $query = '
            SELECT `alias`
            FROM `aliases`
            WHERE `link` = :link
        ';
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([
            'link' => $link,
        ]);
        return $stmt->fetchAll();
    }

    /**
     * @param string $alias
     * @param string $link
     */
    public function setAlias(string $alias, string $link): void
    {
        $dt_create = date(DATETIME_FORMAT);
        $query = '
            INSERT INTO `aliases`(`alias`, `link`, `dt_create`)
            VALUES (:alias, :link, :dt_create)
        ';
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([
            'alias' => $alias,
            'link' => $link,
            'dt_create' => $dt_create,
        ]);
        $query = '
            INSERT INTO `stat`(`alias`, `count`)
            VALUES (:alias, 0)
        ';
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([
            'alias' => $alias,
        ]);
    }

    /**
     * @return array
     */
    public function getAliases(): array
    {
        $query = '
            SELECT
                `a`.`alias`,
                `a`.`link`,
                `a`.`dt_create`,
                `s`.`count`
            FROM `aliases` AS `a`
            LEFT JOIN `stat` AS `s`
                ON `a`.`alias` = `s`.`alias`
        ';
        $stmt = $this->pdo->query($query);
        return $stmt->fetchAll();
    }

    /**
     * @param string $alias
     * @return array
     */
    public function getLinkByAlias(string $alias): array
    {
        $query = '
            SELECT `link`
            FROM `aliases`
            WHERE `alias` = :alias
        ';
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([
            'alias' => $alias,
        ]);
        return $stmt->fetchAll();
    }

    /**
     * @param string $alias
     */
    public function visitAlias(string $alias): void
    {
        $query = '
            UPDATE `stat`
            SET `count` = `count` + 1
            WHERE `alias` = :alias
        ';
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([
            'alias' => $alias,
        ]);
    }
}
