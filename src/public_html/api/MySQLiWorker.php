<?php
class MySQLiWorker {

    protected static $instance;  // object instance
    public $dbName;
    public $dbHost;
    public $dbUser;
    public $dbPassword;
    public $connectLink = null;

    //Чтобы нельзя было создать через вызов new MySQLiWorker
    private function __construct() { /* ... */
    }

    //Чтобы нельзя было создать через клонирование
    private function __clone() { /* ... */
    }

    //Чтобы нельзя было создать через unserialize
    private function __wakeup() { /* ... */
    }

    //Получаем объект синглтона
    public static function getInstance($dbName, $dbHost, $dbUser, $dbPassword) {
        if (is_null(self::$instance)) {
            self::$instance = new MySQLiWorker();
            self::$instance->dbName = $dbName;
            self::$instance->dbHost = $dbHost;
            self::$instance->dbUser = $dbUser;
            self::$instance->dbPassword = $dbPassword;
            self::$instance->openConnection();
        }
        return self::$instance;
    }

    //Определяем типы параметров запроса к базе и возвращаем строку для привязки через ->bind
    function prepareParams($params) {
        $retSTMTString = '';
        foreach ($params as $value) {
            if (is_int($value) || is_double($value)) {
                $retSTMTString.='d';
            }
            if (is_string($value)) {
                $retSTMTString.='s';
            }
        }
        return $retSTMTString;
    }

    //Соединяемся с базой
    public function openConnection() {
        if (is_null($this->connectLink)) {
            $this->connectLink = new mysqli($this->dbHost, $this->dbUser, $this->dbPassword, $this->dbName);
            $this->connectLink->query("SET NAMES utf8");
            if (mysqli_connect_errno()) {
                printf("Подключение невозможно: %s\n", mysqli_connect_error());
                $this->connectLink = null;
            } else {
                mysqli_report(MYSQLI_REPORT_ERROR);
            }
        }
        return $this->connectLink;
    }

    //Закрываем соединение с базой
    public function closeConnection() {
        if (!is_null($this->connectLink)) {
            $this->connectLink->close();
        }
    }

    //Преобразуем ответ в ассоциативный массив
    public function stmt_bind_assoc(&$stmt, &$out) {
        $data = mysqli_stmt_result_metadata($stmt);
        $fields = array();
        $out = array();
        $fields[0] = $stmt;
        $count = 1;
        $currentTable = '';
        while ($field = mysqli_fetch_field($data)) {
            if (strlen($currentTable) == 0) {
                $currentTable = $field->table;
            }
            $fields[$count] = &$out[$field->name];
            $count++;
        }
        call_user_func_array('mysqli_stmt_bind_result', $fields);
    }

}




class DataBase {

  private static $db = null; // Единственный экземпляр класса, чтобы не создавать множество подключений
  private $mysqli; // Идентификатор соединения
  private $sym_query = "{?}"; // "Символ значения в запросе"

  /* Получение экземпляра класса. Если он уже существует, то возвращается, если его не было, то создаётся и возвращается (паттерн Singleton) */
  public static function getDB() {
    if (self::$db == null) self::$db = new DataBase();
    return self::$db;
  }

  /* private-конструктор, подключающийся к базе данных, устанавливающий локаль и кодировку соединения */
  private function __construct() {
    $this->mysqli = new mysqli("localhost", "server", "z1x2c3v4", "fanDOK");
    $this->mysqli->query("SET lc_time_names = 'ru_RU'");
    $this->mysqli->query("SET NAMES 'utf8'");
  }

  /* Вспомогательный метод, который заменяет "символ значения в запросе" на конкретное значение, которое проходит через "функции безопасности" */
  private function getQuery($query, $params) {
    if ($params) {
      for ($i = 0; $i < count($params); $i++) {
        $pos = strpos($query, $this->sym_query);
        $arg = "'".$this->mysqli->real_escape_string($params[$i])."'";
        $query = substr_replace($query, $arg, $pos, strlen($this->sym_query));
    }
    }
    return $query;
  }

  /* SELECT-метод, возвращающий таблицу результатов */
  public function select($query, $params = false) {
    $result_set = $this->mysqli->query($this->getQuery($query, $params));
    if (!$result_set) return false;
    return $this->resultSetToArray($result_set);
  }

  /* SELECT-метод, возвращающий одну строку с результатом */
  public function selectRow($query, $params = false) {
    $result_set = $this->mysqli->query($this->getQuery($query, $params));
    if ($result_set->num_rows != 1) return false;
    else return $result_set->fetch_assoc();
  }

  /* SELECT-метод, возвращающий значение из конкретной ячейки */
  public function selectCell($query, $params = false) {
    $result_set = $this->mysqli->query($this->getQuery($query, $params));
    if ((!$result_set) || ($result_set->num_rows != 1)) return false;
    else {
      $arr = array_values($result_set->fetch_assoc());
      return $arr[0];
    }
  }

  /* НЕ-SELECT методы (INSERT, UPDATE, DELETE). Если запрос INSERT, то возвращается id последней вставленной записи */
  public function query($query, $params = false) {
    $success = $this->mysqli->query($this->getQuery($query, $params));
    if ($success) {
      if ($this->mysqli->insert_id === 0) return true;
      else return $this->mysqli->insert_id;
    }
    else return false;
  }

  /* Преобразование result_set в двумерный массив */
  private function resultSetToArray($result_set) {
    $array = array();
    while (($row = $result_set->fetch_assoc()) != false) {
      $array[] = $row;
    }
    return $array;
  }

  /* При уничтожении объекта закрывается соединение с базой данных */
  public function __destruct() {
    if ($this->mysqli) $this->mysqli->close();
  }
}

?>