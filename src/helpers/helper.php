<?php

class Helper
{
    private static function fetchEntities(mysqli_stmt $stmt, array $fields, string $className): array
    {
        $arr = [];
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            while ($row = $result->fetch_assoc()) {
                $args = [];
                foreach ($fields as $field) {
                    $args[] = $row[$field->value] ?? null;
                }
                $arr[] = new $className(...$args);
            }
        } else {
            throw new Exception("Error executing statement: " . $stmt->error);
        }
        $stmt->close();
        return $arr;
    }

    public static function stringQuery(string $table, array $columns = []): string
    {
        $cols = '*';
        if (!empty($columns)) {
            $filtered = array_filter($columns, fn($value) => !empty($value));
            if (!empty($filtered)) {
                $cols = implode(',', $filtered);
            }
        };
        $query = "SELECT $cols FROM $table";
        return $query;
    }

    public static function stringQueryFind(string $query, string $filterfield): string
    {
        $query .= " WHERE $filterfield = ?";
        return $query;
    }

    public static function stringQuerySearch(string $query, string $filterfield): string
    {
        $query .= " WHERE $filterfield LIKE ?";
        return $query;
    }

    public static function stringQuerySort(string $query, string $filterfield, bool $asc = true, int $limit = 0, int $offset = 0): string
    {
        $query .= " ORDER BY $filterfield";
        if (!$asc) {
            $query .= "  DESC";
        } else {
            $query .= "  ASC";
        }
        if ($limit > 0) {
            $query .= " LIMIT $limit OFFSET $offset";
        }
        return $query;
    }

    public static function getEntities(mysqli $connect, string $className, array $fields, string $query, string $value = ""): array
    {
        $stmt = $connect->prepare($query);
        if (!$stmt) {
            throw new Exception("Error preparing query: " . $connect->error);
        }
        if (!empty($value)) {
            $stmt->bind_param("s", $value);
        }
        return self::fetchEntities($stmt, $fields, $className);
    }

    public static function checkExists(mysqli $connect, string $table, string $whereColumn, string $whereValue): bool
    {
        $sql = "SELECT 1 FROM $table WHERE $whereColumn = ? LIMIT 1";
        $stmt = $connect->prepare($sql);
        if (!$stmt) return false;

        $stmt->bind_param("s", $whereValue);
        $stmt->execute();
        $stmt->store_result();

        $exists = $stmt->num_rows > 0;
        $stmt->close();

        return $exists;
    }


    public static function addData(mysqli $connect, string $table, array $data): bool
    {
        $columns = implode(',', array_keys($data));
        $placeholders = rtrim(str_repeat('?,', count($data)), ','); // ?,?,?...?

        $sql = "INSERT INTO $table ($columns) VALUES ($placeholders)";
        $stmt = $connect->prepare($sql);
        if (!$stmt) {
            throw new Exception("Prepare failed: " . $connect->error);
        }
        $types = '';
        $values = [];

        foreach ($data as $value) {
            if (is_int($value)) {
                $types .= 'i';
            } elseif (is_double($value) || is_float($value)) {
                $types .= 'd';
            } else {
                $types .= 's';
            }
            $values[] = $value;
        }
        $stmt->bind_param($types, ...$values);

        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }

    public static function deleteData(mysqli $connect, string $table, string $whereColumn, string $value): bool
    {
        $query = "DELETE FROM $table WHERE $whereColumn = ?";
        $stmt = $connect->prepare($query);
        if (!$stmt) {
            throw new Exception("Error preparing query: " . $connect->error);
        }

        $stmt->bind_param("s", $value);
        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }

    public static function updateData(mysqli $connect, string $table, array $data, string $whereColumn, string $whereValue): bool
    {
        $set = implode(', ', array_map(fn($col) => "$col = ?", array_keys($data)));

        $sql = "UPDATE $table SET $set WHERE $whereColumn = ?";
        $stmt = $connect->prepare($sql);
        if (!$stmt) {
            throw new Exception("Prepare failed: " . $connect->error);
        }

        $types = '';
        $values = [];

        foreach ($data as $value) {
            if (is_int($value)) {
                $types .= 'i';
            } elseif (is_double($value) || is_float($value)) {
                $types .= 'd';
            } else {
                $types .= 's';
            }
            $values[] = $value;
        }

        if (is_int($whereValue)) {
            $types .= 'i';
        } elseif (is_double($whereValue) || is_float($whereValue)) {
            $types .= 'd';
        } else {
            $types .= 's';
        }
        $values[] = $whereValue;

        $stmt->bind_param($types, ...$values);
        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }
}
