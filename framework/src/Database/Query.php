<?php
/**
 * Copyright (c) 2019. Adrian Schubek.
 * https://framework.adriansoftware.de
 */

namespace Framework\Database;

/**
 * Klasse zum Erstellen von SQL Queries
 * @package Framework\Database
 */
class Query
{
    /**
     * @var array
     */
    private $fields = [];

    /**
     * @var array
     */
    private $from = [];

    /**
     * @var array
     */
    private $where = [];

    /**
     * @var int
     */
    private $limit;

    /**
     * @var int
     */
    private $offset;

    public function select(array $fields): Query
    {
        $this->fields = $fields;
        return $this;
    }

    public function from(string $table, string $alias = null): Query
    {
        if (isset($alias)) {
            $this->from[] = $table . ' AS ' . $alias;
        } else {
            $this->from[] = $table;
        }
        return $this;
    }

    public function where(string $condition): Query
    {
        $this->where[] = $condition;
        return $this;
    }

    public function and(string $condition): Query
    {
        $this->where[] = "AND " . $condition;
        return $this;
    }

    public function or(string $condition): Query
    {
        $this->where[] = "OR " . $condition;
        return $this;
    }

    public function limit(int $length): Query
    {
        $this->limit = $length;
        return $this;
    }

    public function offset(int $length): Query
    {
        $this->offset = $length;
        return $this;
    }

    public function __toString(): string
    {
        return sprintf(
            'SELECT %s FROM %s WHERE %s%s',
            join(', ', $this->fields),
            join(', ', $this->from),
            join(' ', $this->where),
            (isset($this->limit) && isset($this->offset)) ? " LIMIT $this->offset, $this->limit" : ""
        );
    }
}