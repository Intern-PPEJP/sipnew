<?php namespace PHPMaker2020\ppei_20; ?>
<?php

/**
 * Table class for t_coachingtahapan
 */
class t_coachingtahapan extends DbTable
{
	protected $SqlFrom = "";
	protected $SqlSelect = "";
	protected $SqlSelectList = "";
	protected $SqlWhere = "";
	protected $SqlGroupBy = "";
	protected $SqlHaving = "";
	protected $SqlOrderBy = "";
	public $UseSessionForListSql = TRUE;

	// Column CSS classes
	public $LeftColumnClass = "col-sm-2 col-form-label ew-label";
	public $RightColumnClass = "col-sm-10";
	public $OffsetColumnClass = "col-sm-10 offset-sm-2";
	public $TableLeftColumnClass = "w-col-2";

	// Audit trail
	public $AuditTrailOnAdd = TRUE;
	public $AuditTrailOnEdit = TRUE;
	public $AuditTrailOnDelete = TRUE;
	public $AuditTrailOnView = FALSE;
	public $AuditTrailOnViewData = FALSE;
	public $AuditTrailOnSearch = FALSE;

	// Export
	public $ExportDoc;

	// Fields
	public $ctid;
	public $rkid;
	public $area;
	public $jenispel;
	public $kdkategori;
	public $kerjasama;
	public $tglpelak1;
	public $targetpes1;
	public $tglpelak2;
	public $targetpes2;
	public $tglpelak3;
	public $targetpes3;
	public $tglpelak4;
	public $targetpes4;
	public $tglpelak5;
	public $targetpes5;
	public $tglpelak6;
	public $targetpes6;
	public $tglpelak7;
	public $targetpes7;
	public $tglpelak8;
	public $targetpes8;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 't_coachingtahapan';
		$this->TableName = 't_coachingtahapan';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`t_coachingtahapan`";
		$this->Dbid = 'DB';
		$this->ExportAll = TRUE;
		$this->ExportPageBreakCount = 0; // Page break per every n record (PDF only)
		$this->ExportPageOrientation = "portrait"; // Page orientation (PDF only)
		$this->ExportPageSize = "a4"; // Page size (PDF only)
		$this->ExportExcelPageOrientation = ""; // Page orientation (PhpSpreadsheet only)
		$this->ExportExcelPageSize = ""; // Page size (PhpSpreadsheet only)
		$this->ExportWordPageOrientation = "portrait"; // Page orientation (PHPWord only)
		$this->ExportWordColumnWidth = NULL; // Cell width (PHPWord only)
		$this->DetailAdd = FALSE; // Allow detail add
		$this->DetailEdit = FALSE; // Allow detail edit
		$this->DetailView = FALSE; // Allow detail view
		$this->ShowMultipleDetails = FALSE; // Show multiple details
		$this->GridAddRowCount = 1;
		$this->AllowAddDeleteRow = TRUE; // Allow add/delete row
		$this->UserIDAllowSecurity = Config("DEFAULT_USER_ID_ALLOW_SECURITY"); // Default User ID allowed permissions
		$this->BasicSearch = new BasicSearch($this->TableVar);

		// ctid
		$this->ctid = new DbField('t_coachingtahapan', 't_coachingtahapan', 'x_ctid', 'ctid', '`ctid`', '`ctid`', 3, 11, -1, FALSE, '`ctid`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->ctid->IsAutoIncrement = TRUE; // Autoincrement field
		$this->ctid->IsPrimaryKey = TRUE; // Primary key field
		$this->ctid->Sortable = TRUE; // Allow sort
		$this->ctid->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['ctid'] = &$this->ctid;

		// rkid
		$this->rkid = new DbField('t_coachingtahapan', 't_coachingtahapan', 'x_rkid', 'rkid', '`rkid`', '`rkid`', 3, 11, -1, FALSE, '`rkid`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->rkid->IsForeignKey = TRUE; // Foreign key field
		$this->rkid->Nullable = FALSE; // NOT NULL field
		$this->rkid->Required = TRUE; // Required field
		$this->rkid->Sortable = TRUE; // Allow sort
		$this->rkid->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['rkid'] = &$this->rkid;

		// area
		$this->area = new DbField('t_coachingtahapan', 't_coachingtahapan', 'x_area', 'area', '`area`', '`area`', 200, 100, -1, FALSE, '`EV__area`', TRUE, TRUE, TRUE, 'FORMATTED TEXT', 'SELECT');
		$this->area->IsForeignKey = TRUE; // Foreign key field
		$this->area->Required = TRUE; // Required field
		$this->area->Sortable = TRUE; // Allow sort
		$this->area->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->area->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->area->Lookup = new Lookup('area', 't_area', FALSE, 'areaid', ["area","ket","",""], [], [], [], [], [], [], '', '');
		$this->fields['area'] = &$this->area;

		// jenispel
		$this->jenispel = new DbField('t_coachingtahapan', 't_coachingtahapan', 'x_jenispel', 'jenispel', '`jenispel`', '`jenispel`', 3, 2, -1, FALSE, '`jenispel`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->jenispel->Nullable = FALSE; // NOT NULL field
		$this->jenispel->Required = TRUE; // Required field
		$this->jenispel->Sortable = TRUE; // Allow sort
		$this->jenispel->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->jenispel->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->jenispel->Lookup = new Lookup('jenispel', 't_coachingtahapan', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->jenispel->OptionCount = 11;
		$this->jenispel->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['jenispel'] = &$this->jenispel;

		// kdkategori
		$this->kdkategori = new DbField('t_coachingtahapan', 't_coachingtahapan', 'x_kdkategori', 'kdkategori', '`kdkategori`', '`kdkategori`', 3, 11, -1, FALSE, '`kdkategori`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->kdkategori->Nullable = FALSE; // NOT NULL field
		$this->kdkategori->Required = TRUE; // Required field
		$this->kdkategori->Sortable = TRUE; // Allow sort
		$this->kdkategori->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->kdkategori->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->kdkategori->Lookup = new Lookup('kdkategori', 't_kategori', FALSE, 'kdkategori', ["kategori","","",""], [], ["x_kerjasama"], [], [], [], [], '`kdkategori` ASC', '');
		$this->kdkategori->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['kdkategori'] = &$this->kdkategori;

		// kerjasama
		$this->kerjasama = new DbField('t_coachingtahapan', 't_coachingtahapan', 'x_kerjasama', 'kerjasama', '`kerjasama`', '`kerjasama`', 3, 11, -1, FALSE, '`kerjasama`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->kerjasama->Nullable = FALSE; // NOT NULL field
		$this->kerjasama->Required = TRUE; // Required field
		$this->kerjasama->Sortable = TRUE; // Allow sort
		$this->kerjasama->Lookup = new Lookup('kerjasama', 't_perusahaan', FALSE, 'idp', ["namap","","",""], ["x_kdkategori"], [], ["kdkategori"], ["x_kdkategori"], [], [], '`namap` ASC', '');
		$this->kerjasama->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['kerjasama'] = &$this->kerjasama;

		// tglpelak1
		$this->tglpelak1 = new DbField('t_coachingtahapan', 't_coachingtahapan', 'x_tglpelak1', 'tglpelak1', '`tglpelak1`', '`tglpelak1`', 200, 25, -1, FALSE, '`tglpelak1`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->tglpelak1->Sortable = TRUE; // Allow sort
		$this->fields['tglpelak1'] = &$this->tglpelak1;

		// targetpes1
		$this->targetpes1 = new DbField('t_coachingtahapan', 't_coachingtahapan', 'x_targetpes1', 'targetpes1', '`targetpes1`', '`targetpes1`', 3, 3, -1, FALSE, '`targetpes1`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->targetpes1->Sortable = TRUE; // Allow sort
		$this->targetpes1->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['targetpes1'] = &$this->targetpes1;

		// tglpelak2
		$this->tglpelak2 = new DbField('t_coachingtahapan', 't_coachingtahapan', 'x_tglpelak2', 'tglpelak2', '`tglpelak2`', '`tglpelak2`', 200, 25, -1, FALSE, '`tglpelak2`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->tglpelak2->Sortable = TRUE; // Allow sort
		$this->fields['tglpelak2'] = &$this->tglpelak2;

		// targetpes2
		$this->targetpes2 = new DbField('t_coachingtahapan', 't_coachingtahapan', 'x_targetpes2', 'targetpes2', '`targetpes2`', '`targetpes2`', 3, 3, -1, FALSE, '`targetpes2`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->targetpes2->Sortable = TRUE; // Allow sort
		$this->targetpes2->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['targetpes2'] = &$this->targetpes2;

		// tglpelak3
		$this->tglpelak3 = new DbField('t_coachingtahapan', 't_coachingtahapan', 'x_tglpelak3', 'tglpelak3', '`tglpelak3`', '`tglpelak3`', 200, 25, -1, FALSE, '`tglpelak3`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->tglpelak3->Sortable = TRUE; // Allow sort
		$this->fields['tglpelak3'] = &$this->tglpelak3;

		// targetpes3
		$this->targetpes3 = new DbField('t_coachingtahapan', 't_coachingtahapan', 'x_targetpes3', 'targetpes3', '`targetpes3`', '`targetpes3`', 3, 3, -1, FALSE, '`targetpes3`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->targetpes3->Sortable = TRUE; // Allow sort
		$this->targetpes3->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['targetpes3'] = &$this->targetpes3;

		// tglpelak4
		$this->tglpelak4 = new DbField('t_coachingtahapan', 't_coachingtahapan', 'x_tglpelak4', 'tglpelak4', '`tglpelak4`', '`tglpelak4`', 200, 25, -1, FALSE, '`tglpelak4`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->tglpelak4->Sortable = TRUE; // Allow sort
		$this->fields['tglpelak4'] = &$this->tglpelak4;

		// targetpes4
		$this->targetpes4 = new DbField('t_coachingtahapan', 't_coachingtahapan', 'x_targetpes4', 'targetpes4', '`targetpes4`', '`targetpes4`', 3, 3, -1, FALSE, '`targetpes4`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->targetpes4->Sortable = TRUE; // Allow sort
		$this->targetpes4->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['targetpes4'] = &$this->targetpes4;

		// tglpelak5
		$this->tglpelak5 = new DbField('t_coachingtahapan', 't_coachingtahapan', 'x_tglpelak5', 'tglpelak5', '`tglpelak5`', '`tglpelak5`', 200, 25, -1, FALSE, '`tglpelak5`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->tglpelak5->Sortable = TRUE; // Allow sort
		$this->fields['tglpelak5'] = &$this->tglpelak5;

		// targetpes5
		$this->targetpes5 = new DbField('t_coachingtahapan', 't_coachingtahapan', 'x_targetpes5', 'targetpes5', '`targetpes5`', '`targetpes5`', 3, 3, -1, FALSE, '`targetpes5`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->targetpes5->Sortable = TRUE; // Allow sort
		$this->targetpes5->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['targetpes5'] = &$this->targetpes5;

		// tglpelak6
		$this->tglpelak6 = new DbField('t_coachingtahapan', 't_coachingtahapan', 'x_tglpelak6', 'tglpelak6', '`tglpelak6`', '`tglpelak6`', 200, 25, -1, FALSE, '`tglpelak6`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->tglpelak6->Sortable = TRUE; // Allow sort
		$this->fields['tglpelak6'] = &$this->tglpelak6;

		// targetpes6
		$this->targetpes6 = new DbField('t_coachingtahapan', 't_coachingtahapan', 'x_targetpes6', 'targetpes6', '`targetpes6`', '`targetpes6`', 3, 3, -1, FALSE, '`targetpes6`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->targetpes6->Sortable = TRUE; // Allow sort
		$this->targetpes6->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['targetpes6'] = &$this->targetpes6;

		// tglpelak7
		$this->tglpelak7 = new DbField('t_coachingtahapan', 't_coachingtahapan', 'x_tglpelak7', 'tglpelak7', '`tglpelak7`', '`tglpelak7`', 200, 25, -1, FALSE, '`tglpelak7`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->tglpelak7->Sortable = TRUE; // Allow sort
		$this->fields['tglpelak7'] = &$this->tglpelak7;

		// targetpes7
		$this->targetpes7 = new DbField('t_coachingtahapan', 't_coachingtahapan', 'x_targetpes7', 'targetpes7', '`targetpes7`', '`targetpes7`', 3, 3, -1, FALSE, '`targetpes7`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->targetpes7->Sortable = TRUE; // Allow sort
		$this->targetpes7->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['targetpes7'] = &$this->targetpes7;

		// tglpelak8
		$this->tglpelak8 = new DbField('t_coachingtahapan', 't_coachingtahapan', 'x_tglpelak8', 'tglpelak8', '`tglpelak8`', '`tglpelak8`', 200, 25, -1, FALSE, '`tglpelak8`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->tglpelak8->Sortable = TRUE; // Allow sort
		$this->fields['tglpelak8'] = &$this->tglpelak8;

		// targetpes8
		$this->targetpes8 = new DbField('t_coachingtahapan', 't_coachingtahapan', 'x_targetpes8', 'targetpes8', '`targetpes8`', '`targetpes8`', 3, 3, -1, FALSE, '`targetpes8`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->targetpes8->Sortable = TRUE; // Allow sort
		$this->targetpes8->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['targetpes8'] = &$this->targetpes8;
	}

	// Field Visibility
	public function getFieldVisibility($fldParm)
	{
		global $Security;
		return $this->$fldParm->Visible; // Returns original value
	}

	// Set left column class (must be predefined col-*-* classes of Bootstrap grid system)
	function setLeftColumnClass($class)
	{
		if (preg_match('/^col\-(\w+)\-(\d+)$/', $class, $match)) {
			$this->LeftColumnClass = $class . " col-form-label ew-label";
			$this->RightColumnClass = "col-" . $match[1] . "-" . strval(12 - (int)$match[2]);
			$this->OffsetColumnClass = $this->RightColumnClass . " " . str_replace("col-", "offset-", $class);
			$this->TableLeftColumnClass = preg_replace('/^col-\w+-(\d+)$/', "w-col-$1", $class); // Change to w-col-*
		}
	}

	// Single column sort
	public function updateSort(&$fld)
	{
		if ($this->CurrentOrder == $fld->Name) {
			$sortField = $fld->Expression;
			$lastSort = $fld->getSort();
			if ($this->CurrentOrderType == "ASC" || $this->CurrentOrderType == "DESC") {
				$thisSort = $this->CurrentOrderType;
			} else {
				$thisSort = ($lastSort == "ASC") ? "DESC" : "ASC";
			}
			$fld->setSort($thisSort);
			$this->setSessionOrderBy($sortField . " " . $thisSort); // Save to Session
			$sortFieldList = ($fld->VirtualExpression != "") ? $fld->VirtualExpression : $sortField;
			$this->setSessionOrderByList($sortFieldList . " " . $thisSort); // Save to Session
		} else {
			$fld->setSort("");
		}
	}

	// Session ORDER BY for List page
	public function getSessionOrderByList()
	{
		return @$_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_ORDER_BY_LIST")];
	}
	public function setSessionOrderByList($v)
	{
		$_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_ORDER_BY_LIST")] = $v;
	}

	// Current master table name
	public function getCurrentMasterTable()
	{
		return @$_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_MASTER_TABLE")];
	}
	public function setCurrentMasterTable($v)
	{
		$_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_MASTER_TABLE")] = $v;
	}

	// Session master WHERE clause
	public function getMasterFilter()
	{

		// Master filter
		$masterFilter = "";
		if ($this->getCurrentMasterTable() == "t_rkcoaching") {
			if ($this->rkid->getSessionValue() != "")
				$masterFilter .= "`rkid`=" . QuotedValue($this->rkid->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
			if ($this->area->getSessionValue() != "")
				$masterFilter .= " AND `area`=" . QuotedValue($this->area->getSessionValue(), DATATYPE_STRING, "DB");
			else
				return "";
		}
		return $masterFilter;
	}

	// Session detail WHERE clause
	public function getDetailFilter()
	{

		// Detail filter
		$detailFilter = "";
		if ($this->getCurrentMasterTable() == "t_rkcoaching") {
			if ($this->rkid->getSessionValue() != "")
				$detailFilter .= "`rkid`=" . QuotedValue($this->rkid->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
			if ($this->area->getSessionValue() != "")
				$detailFilter .= " AND `area`=" . QuotedValue($this->area->getSessionValue(), DATATYPE_STRING, "DB");
			else
				return "";
		}
		return $detailFilter;
	}

	// Master filter
	public function sqlMasterFilter_t_rkcoaching()
	{
		return "`rkid`=@rkid@ AND `area`='@area@'";
	}

	// Detail filter
	public function sqlDetailFilter_t_rkcoaching()
	{
		return "`rkid`=@rkid@ AND `area`='@area@'";
	}

	// Table level SQL
	public function getSqlFrom() // From
	{
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`t_coachingtahapan`";
	}
	public function sqlFrom() // For backward compatibility
	{
		return $this->getSqlFrom();
	}
	public function setSqlFrom($v)
	{
		$this->SqlFrom = $v;
	}
	public function getSqlSelect() // Select
	{
		return ($this->SqlSelect != "") ? $this->SqlSelect : "SELECT * FROM " . $this->getSqlFrom();
	}
	public function sqlSelect() // For backward compatibility
	{
		return $this->getSqlSelect();
	}
	public function setSqlSelect($v)
	{
		$this->SqlSelect = $v;
	}
	public function getSqlSelectList() // Select for List page
	{
		$select = "";
		$select = "SELECT * FROM (" .
			"SELECT *, (SELECT CONCAT(COALESCE(`area`, ''),'" . ValueSeparator(1, $this->area) . "',COALESCE(`ket`,'')) FROM `t_area` `TMP_LOOKUPTABLE` WHERE `TMP_LOOKUPTABLE`.`areaid` = `t_coachingtahapan`.`area` LIMIT 1) AS `EV__area` FROM `t_coachingtahapan`" .
			") `TMP_TABLE`";
		return ($this->SqlSelectList != "") ? $this->SqlSelectList : $select;
	}
	public function sqlSelectList() // For backward compatibility
	{
		return $this->getSqlSelectList();
	}
	public function setSqlSelectList($v)
	{
		$this->SqlSelectList = $v;
	}
	public function getSqlWhere() // Where
	{
		$where = ($this->SqlWhere != "") ? $this->SqlWhere : "";
		$this->TableFilter = "";
		AddFilter($where, $this->TableFilter);
		return $where;
	}
	public function sqlWhere() // For backward compatibility
	{
		return $this->getSqlWhere();
	}
	public function setSqlWhere($v)
	{
		$this->SqlWhere = $v;
	}
	public function getSqlGroupBy() // Group By
	{
		return ($this->SqlGroupBy != "") ? $this->SqlGroupBy : "";
	}
	public function sqlGroupBy() // For backward compatibility
	{
		return $this->getSqlGroupBy();
	}
	public function setSqlGroupBy($v)
	{
		$this->SqlGroupBy = $v;
	}
	public function getSqlHaving() // Having
	{
		return ($this->SqlHaving != "") ? $this->SqlHaving : "";
	}
	public function sqlHaving() // For backward compatibility
	{
		return $this->getSqlHaving();
	}
	public function setSqlHaving($v)
	{
		$this->SqlHaving = $v;
	}
	public function getSqlOrderBy() // Order By
	{
		return ($this->SqlOrderBy != "") ? $this->SqlOrderBy : "";
	}
	public function sqlOrderBy() // For backward compatibility
	{
		return $this->getSqlOrderBy();
	}
	public function setSqlOrderBy($v)
	{
		$this->SqlOrderBy = $v;
	}

	// Apply User ID filters
	public function applyUserIDFilters($filter, $id = "")
	{
		return $filter;
	}

	// Check if User ID security allows view all
	public function userIDAllow($id = "")
	{
		$allow = $this->UserIDAllowSecurity;
		switch ($id) {
			case "add":
			case "copy":
			case "gridadd":
			case "register":
			case "addopt":
				return (($allow & 1) == 1);
			case "edit":
			case "gridedit":
			case "update":
			case "changepwd":
			case "forgotpwd":
				return (($allow & 4) == 4);
			case "delete":
				return (($allow & 2) == 2);
			case "view":
				return (($allow & 32) == 32);
			case "search":
				return (($allow & 64) == 64);
			case "lookup":
				return (($allow & 256) == 256);
			default:
				return (($allow & 8) == 8);
		}
	}

	// Get recordset
	public function getRecordset($sql, $rowcnt = -1, $offset = -1)
	{
		$conn = $this->getConnection();
		$conn->raiseErrorFn = Config("ERROR_FUNC");
		$rs = $conn->selectLimit($sql, $rowcnt, $offset);
		$conn->raiseErrorFn = "";
		return $rs;
	}

	// Get record count
	public function getRecordCount($sql, $c = NULL)
	{
		$cnt = -1;
		$rs = NULL;
		$sql = preg_replace('/\/\*BeginOrderBy\*\/[\s\S]+\/\*EndOrderBy\*\//', "", $sql); // Remove ORDER BY clause (MSSQL)
		$pattern = '/^SELECT\s([\s\S]+)\sFROM\s/i';

		// Skip Custom View / SubQuery / SELECT DISTINCT / ORDER BY
		if (($this->TableType == 'TABLE' || $this->TableType == 'VIEW' || $this->TableType == 'LINKTABLE') &&
			preg_match($pattern, $sql) && !preg_match('/\(\s*(SELECT[^)]+)\)/i', $sql) &&
			!preg_match('/^\s*select\s+distinct\s+/i', $sql) && !preg_match('/\s+order\s+by\s+/i', $sql)) {
			$sqlwrk = "SELECT COUNT(*) FROM " . preg_replace($pattern, "", $sql);
		} else {
			$sqlwrk = "SELECT COUNT(*) FROM (" . $sql . ") COUNT_TABLE";
		}
		$conn = $c ?: $this->getConnection();
		if ($rs = $conn->execute($sqlwrk)) {
			if (!$rs->EOF && $rs->FieldCount() > 0) {
				$cnt = $rs->fields[0];
				$rs->close();
			}
			return (int)$cnt;
		}

		// Unable to get count, get record count directly
		if ($rs = $conn->execute($sql)) {
			$cnt = $rs->RecordCount();
			$rs->close();
			return (int)$cnt;
		}
		return $cnt;
	}

	// Get SQL
	public function getSql($where, $orderBy = "")
	{
		return BuildSelectSql($this->getSqlSelect(), $this->getSqlWhere(),
			$this->getSqlGroupBy(), $this->getSqlHaving(), $this->getSqlOrderBy(),
			$where, $orderBy);
	}

	// Table SQL
	public function getCurrentSql()
	{
		$filter = $this->CurrentFilter;
		$filter = $this->applyUserIDFilters($filter);
		$sort = $this->getSessionOrderBy();
		return $this->getSql($filter, $sort);
	}

	// Table SQL with List page filter
	public function getListSql()
	{
		$filter = $this->UseSessionForListSql ? $this->getSessionWhere() : "";
		AddFilter($filter, $this->CurrentFilter);
		$filter = $this->applyUserIDFilters($filter);
		$this->Recordset_Selecting($filter);
		if ($this->useVirtualFields()) {
			$select = $this->getSqlSelectList();
			$sort = $this->UseSessionForListSql ? $this->getSessionOrderByList() : "";
		} else {
			$select = $this->getSqlSelect();
			$sort = $this->UseSessionForListSql ? $this->getSessionOrderBy() : "";
		}
		return BuildSelectSql($select, $this->getSqlWhere(), $this->getSqlGroupBy(),
			$this->getSqlHaving(), $this->getSqlOrderBy(), $filter, $sort);
	}

	// Get ORDER BY clause
	public function getOrderBy()
	{
		$sort = ($this->useVirtualFields()) ? $this->getSessionOrderByList() : $this->getSessionOrderBy();
		return BuildSelectSql("", "", "", "", $this->getSqlOrderBy(), "", $sort);
	}

	// Check if virtual fields is used in SQL
	protected function useVirtualFields()
	{
		$where = $this->UseSessionForListSql ? $this->getSessionWhere() : $this->CurrentFilter;
		$orderBy = $this->UseSessionForListSql ? $this->getSessionOrderByList() : "";
		if ($where != "")
			$where = " " . str_replace(["(", ")"], ["", ""], $where) . " ";
		if ($orderBy != "")
			$orderBy = " " . str_replace(["(", ")"], ["", ""], $orderBy) . " ";
		if ($this->area->AdvancedSearch->SearchValue != "" ||
			$this->area->AdvancedSearch->SearchValue2 != "" ||
			ContainsString($where, " " . $this->area->VirtualExpression . " "))
			return TRUE;
		if (ContainsString($orderBy, " " . $this->area->VirtualExpression . " "))
			return TRUE;
		return FALSE;
	}

	// Get record count based on filter (for detail record count in master table pages)
	public function loadRecordCount($filter)
	{
		$origFilter = $this->CurrentFilter;
		$this->CurrentFilter = $filter;
		$this->Recordset_Selecting($this->CurrentFilter);
		$select = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlSelect() : "SELECT * FROM " . $this->getSqlFrom();
		$groupBy = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlGroupBy() : "";
		$having = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlHaving() : "";
		$sql = BuildSelectSql($select, $this->getSqlWhere(), $groupBy, $having, "", $this->CurrentFilter, "");
		$cnt = $this->getRecordCount($sql);
		$this->CurrentFilter = $origFilter;
		return $cnt;
	}

	// Get record count (for current List page)
	public function listRecordCount()
	{
		$filter = $this->getSessionWhere();
		AddFilter($filter, $this->CurrentFilter);
		$filter = $this->applyUserIDFilters($filter);
		$this->Recordset_Selecting($filter);
		$select = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlSelect() : "SELECT * FROM " . $this->getSqlFrom();
		$groupBy = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlGroupBy() : "";
		$having = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlHaving() : "";
		if ($this->useVirtualFields())
			$sql = BuildSelectSql($this->getSqlSelectList(), $this->getSqlWhere(), $groupBy, $having, "", $filter, "");
		else
			$sql = BuildSelectSql($select, $this->getSqlWhere(), $groupBy, $having, "", $filter, "");
		$cnt = $this->getRecordCount($sql);
		return $cnt;
	}

	// INSERT statement
	protected function insertSql(&$rs)
	{
		$names = "";
		$values = "";
		foreach ($rs as $name => $value) {
			if (!isset($this->fields[$name]) || $this->fields[$name]->IsCustom)
				continue;
			$names .= $this->fields[$name]->Expression . ",";
			$values .= QuotedValue($value, $this->fields[$name]->DataType, $this->Dbid) . ",";
		}
		$names = preg_replace('/,+$/', "", $names);
		$values = preg_replace('/,+$/', "", $values);
		return "INSERT INTO " . $this->UpdateTable . " (" . $names . ") VALUES (" . $values . ")";
	}

	// Insert
	public function insert(&$rs)
	{
		$conn = $this->getConnection();
		$success = $conn->execute($this->insertSql($rs));
		if ($success) {

			// Get insert id if necessary
			$this->ctid->setDbValue($conn->insert_ID());
			$rs['ctid'] = $this->ctid->DbValue;
			if ($this->AuditTrailOnAdd)
				$this->writeAuditTrailOnAdd($rs);
		}
		return $success;
	}

	// UPDATE statement
	protected function updateSql(&$rs, $where = "", $curfilter = TRUE)
	{
		$sql = "UPDATE " . $this->UpdateTable . " SET ";
		foreach ($rs as $name => $value) {
			if (!isset($this->fields[$name]) || $this->fields[$name]->IsCustom || $this->fields[$name]->IsAutoIncrement)
				continue;
			$sql .= $this->fields[$name]->Expression . "=";
			$sql .= QuotedValue($value, $this->fields[$name]->DataType, $this->Dbid) . ",";
		}
		$sql = preg_replace('/,+$/', "", $sql);
		$filter = ($curfilter) ? $this->CurrentFilter : "";
		if (is_array($where))
			$where = $this->arrayToFilter($where);
		AddFilter($filter, $where);
		if ($filter != "")
			$sql .= " WHERE " . $filter;
		return $sql;
	}

	// Update
	public function update(&$rs, $where = "", $rsold = NULL, $curfilter = TRUE)
	{
		$conn = $this->getConnection();
		$success = $conn->execute($this->updateSql($rs, $where, $curfilter));
		if ($success && $this->AuditTrailOnEdit && $rsold) {
			$rsaudit = $rs;
			$fldname = 'ctid';
			if (!array_key_exists($fldname, $rsaudit))
				$rsaudit[$fldname] = $rsold[$fldname];
			$this->writeAuditTrailOnEdit($rsold, $rsaudit);
		}
		return $success;
	}

	// DELETE statement
	protected function deleteSql(&$rs, $where = "", $curfilter = TRUE)
	{
		$sql = "DELETE FROM " . $this->UpdateTable . " WHERE ";
		if (is_array($where))
			$where = $this->arrayToFilter($where);
		if ($rs) {
			if (array_key_exists('ctid', $rs))
				AddFilter($where, QuotedName('ctid', $this->Dbid) . '=' . QuotedValue($rs['ctid'], $this->ctid->DataType, $this->Dbid));
		}
		$filter = ($curfilter) ? $this->CurrentFilter : "";
		AddFilter($filter, $where);
		if ($filter != "")
			$sql .= $filter;
		else
			$sql .= "0=1"; // Avoid delete
		return $sql;
	}

	// Delete
	public function delete(&$rs, $where = "", $curfilter = FALSE)
	{
		$success = TRUE;
		$conn = $this->getConnection();
		if ($success)
			$success = $conn->execute($this->deleteSql($rs, $where, $curfilter));
		if ($success && $this->AuditTrailOnDelete)
			$this->writeAuditTrailOnDelete($rs);
		return $success;
	}

	// Load DbValue from recordset or array
	protected function loadDbValues(&$rs)
	{
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->ctid->DbValue = $row['ctid'];
		$this->rkid->DbValue = $row['rkid'];
		$this->area->DbValue = $row['area'];
		$this->jenispel->DbValue = $row['jenispel'];
		$this->kdkategori->DbValue = $row['kdkategori'];
		$this->kerjasama->DbValue = $row['kerjasama'];
		$this->tglpelak1->DbValue = $row['tglpelak1'];
		$this->targetpes1->DbValue = $row['targetpes1'];
		$this->tglpelak2->DbValue = $row['tglpelak2'];
		$this->targetpes2->DbValue = $row['targetpes2'];
		$this->tglpelak3->DbValue = $row['tglpelak3'];
		$this->targetpes3->DbValue = $row['targetpes3'];
		$this->tglpelak4->DbValue = $row['tglpelak4'];
		$this->targetpes4->DbValue = $row['targetpes4'];
		$this->tglpelak5->DbValue = $row['tglpelak5'];
		$this->targetpes5->DbValue = $row['targetpes5'];
		$this->tglpelak6->DbValue = $row['tglpelak6'];
		$this->targetpes6->DbValue = $row['targetpes6'];
		$this->tglpelak7->DbValue = $row['tglpelak7'];
		$this->targetpes7->DbValue = $row['targetpes7'];
		$this->tglpelak8->DbValue = $row['tglpelak8'];
		$this->targetpes8->DbValue = $row['targetpes8'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "`ctid` = @ctid@";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		if (is_array($row))
			$val = array_key_exists('ctid', $row) ? $row['ctid'] : NULL;
		else
			$val = $this->ctid->OldValue !== NULL ? $this->ctid->OldValue : $this->ctid->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@ctid@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
		return $keyFilter;
	}

	// Return page URL
	public function getReturnUrl()
	{
		$name = PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_RETURN_URL");

		// Get referer URL automatically
		if (ServerVar("HTTP_REFERER") != "" && ReferPageName() != CurrentPageName() && ReferPageName() != "login.php") // Referer not same page or login page
			$_SESSION[$name] = ServerVar("HTTP_REFERER"); // Save to Session
		if (@$_SESSION[$name] != "") {
			return $_SESSION[$name];
		} else {
			return "t_coachingtahapanlist.php";
		}
	}
	public function setReturnUrl($v)
	{
		$_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_RETURN_URL")] = $v;
	}

	// Get modal caption
	public function getModalCaption($pageName)
	{
		global $Language;
		if ($pageName == "t_coachingtahapanview.php")
			return $Language->phrase("View");
		elseif ($pageName == "t_coachingtahapanedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "t_coachingtahapanadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "t_coachingtahapanlist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("t_coachingtahapanview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("t_coachingtahapanview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "t_coachingtahapanadd.php?" . $this->getUrlParm($parm);
		else
			$url = "t_coachingtahapanadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("t_coachingtahapanedit.php", $this->getUrlParm($parm));
		return $this->addMasterUrl($url);
	}

	// Inline edit URL
	public function getInlineEditUrl()
	{
		$url = $this->keyUrl(CurrentPageName(), $this->getUrlParm("action=edit"));
		return $this->addMasterUrl($url);
	}

	// Copy URL
	public function getCopyUrl($parm = "")
	{
		$url = $this->keyUrl("t_coachingtahapanadd.php", $this->getUrlParm($parm));
		return $this->addMasterUrl($url);
	}

	// Inline copy URL
	public function getInlineCopyUrl()
	{
		$url = $this->keyUrl(CurrentPageName(), $this->getUrlParm("action=copy"));
		return $this->addMasterUrl($url);
	}

	// Delete URL
	public function getDeleteUrl()
	{
		return $this->keyUrl("t_coachingtahapandelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		if ($this->getCurrentMasterTable() == "t_rkcoaching" && !ContainsString($url, Config("TABLE_SHOW_MASTER") . "=")) {
			$url .= (ContainsString($url, "?") ? "&" : "?") . Config("TABLE_SHOW_MASTER") . "=" . $this->getCurrentMasterTable();
			$url .= "&fk_rkid=" . urlencode($this->rkid->CurrentValue);
			$url .= "&fk_area=" . urlencode($this->area->CurrentValue);
		}
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "ctid:" . JsonEncode($this->ctid->CurrentValue, "number");
		$json = "{" . $json . "}";
		if ($htmlEncode)
			$json = HtmlEncode($json);
		return $json;
	}

	// Add key value to URL
	public function keyUrl($url, $parm = "")
	{
		$url = $url . "?";
		if ($parm != "")
			$url .= $parm . "&";
		if ($this->ctid->CurrentValue != NULL) {
			$url .= "ctid=" . urlencode($this->ctid->CurrentValue);
		} else {
			return "javascript:ew.alert(ew.language.phrase('InvalidRecord'));";
		}
		return $url;
	}

	// Sort URL
	public function sortUrl(&$fld)
	{
		if ($this->CurrentAction || $this->isExport() ||
			in_array($fld->Type, [128, 204, 205])) { // Unsortable data type
				return "";
		} elseif ($fld->Sortable) {
			$urlParm = $this->getUrlParm("order=" . urlencode($fld->Name) . "&amp;ordertype=" . $fld->reverseSort());
			return $this->addMasterUrl(CurrentPageName() . "?" . $urlParm);
		} else {
			return "";
		}
	}

	// Get record keys from Post/Get/Session
	public function getRecordKeys()
	{
		$arKeys = [];
		$arKey = [];
		if (Param("key_m") !== NULL) {
			$arKeys = Param("key_m");
			$cnt = count($arKeys);
		} else {
			if (Param("ctid") !== NULL)
				$arKeys[] = Param("ctid");
			elseif (IsApi() && Key(0) !== NULL)
				$arKeys[] = Key(0);
			elseif (IsApi() && Route(2) !== NULL)
				$arKeys[] = Route(2);
			else
				$arKeys = NULL; // Do not setup

			//return $arKeys; // Do not return yet, so the values will also be checked by the following code
		}

		// Check keys
		$ar = [];
		if (is_array($arKeys)) {
			foreach ($arKeys as $key) {
				if (!is_numeric($key))
					continue;
				$ar[] = $key;
			}
		}
		return $ar;
	}

	// Get filter from record keys
	public function getFilterFromRecordKeys($setCurrent = TRUE)
	{
		$arKeys = $this->getRecordKeys();
		$keyFilter = "";
		foreach ($arKeys as $key) {
			if ($keyFilter != "") $keyFilter .= " OR ";
			if ($setCurrent)
				$this->ctid->CurrentValue = $key;
			else
				$this->ctid->OldValue = $key;
			$keyFilter .= "(" . $this->getRecordFilter() . ")";
		}
		return $keyFilter;
	}

	// Load rows based on filter
	public function &loadRs($filter)
	{

		// Set up filter (WHERE Clause)
		$sql = $this->getSql($filter);
		$conn = $this->getConnection();
		$rs = $conn->execute($sql);
		return $rs;
	}

	// Load row values from recordset
	public function loadListRowValues(&$rs)
	{
		$this->ctid->setDbValue($rs->fields('ctid'));
		$this->rkid->setDbValue($rs->fields('rkid'));
		$this->area->setDbValue($rs->fields('area'));
		$this->jenispel->setDbValue($rs->fields('jenispel'));
		$this->kdkategori->setDbValue($rs->fields('kdkategori'));
		$this->kerjasama->setDbValue($rs->fields('kerjasama'));
		$this->tglpelak1->setDbValue($rs->fields('tglpelak1'));
		$this->targetpes1->setDbValue($rs->fields('targetpes1'));
		$this->tglpelak2->setDbValue($rs->fields('tglpelak2'));
		$this->targetpes2->setDbValue($rs->fields('targetpes2'));
		$this->tglpelak3->setDbValue($rs->fields('tglpelak3'));
		$this->targetpes3->setDbValue($rs->fields('targetpes3'));
		$this->tglpelak4->setDbValue($rs->fields('tglpelak4'));
		$this->targetpes4->setDbValue($rs->fields('targetpes4'));
		$this->tglpelak5->setDbValue($rs->fields('tglpelak5'));
		$this->targetpes5->setDbValue($rs->fields('targetpes5'));
		$this->tglpelak6->setDbValue($rs->fields('tglpelak6'));
		$this->targetpes6->setDbValue($rs->fields('targetpes6'));
		$this->tglpelak7->setDbValue($rs->fields('tglpelak7'));
		$this->targetpes7->setDbValue($rs->fields('targetpes7'));
		$this->tglpelak8->setDbValue($rs->fields('tglpelak8'));
		$this->targetpes8->setDbValue($rs->fields('targetpes8'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// ctid
		// rkid
		// area
		// jenispel
		// kdkategori
		// kerjasama
		// tglpelak1
		// targetpes1
		// tglpelak2
		// targetpes2
		// tglpelak3
		// targetpes3
		// tglpelak4
		// targetpes4
		// tglpelak5
		// targetpes5
		// tglpelak6
		// targetpes6
		// tglpelak7
		// targetpes7
		// tglpelak8
		// targetpes8
		// ctid

		$this->ctid->ViewValue = $this->ctid->CurrentValue;
		$this->ctid->ViewCustomAttributes = "";

		// rkid
		$this->rkid->ViewValue = $this->rkid->CurrentValue;
		$this->rkid->ViewCustomAttributes = "";

		// area
		if ($this->area->VirtualValue != "") {
			$this->area->ViewValue = $this->area->VirtualValue;
		} else {
			$curVal = strval($this->area->CurrentValue);
			if ($curVal != "") {
				$this->area->ViewValue = $this->area->lookupCacheOption($curVal);
				if ($this->area->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`areaid`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->area->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$arwrk[2] = $rswrk->fields('df2');
						$this->area->ViewValue = $this->area->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->area->ViewValue = $this->area->CurrentValue;
					}
				}
			} else {
				$this->area->ViewValue = NULL;
			}
		}
		$this->area->ViewCustomAttributes = "";

		// jenispel
		if (strval($this->jenispel->CurrentValue) != "") {
			$this->jenispel->ViewValue = $this->jenispel->optionCaption($this->jenispel->CurrentValue);
		} else {
			$this->jenispel->ViewValue = NULL;
		}
		$this->jenispel->ViewCustomAttributes = "";

		// kdkategori
		$curVal = strval($this->kdkategori->CurrentValue);
		if ($curVal != "") {
			$this->kdkategori->ViewValue = $this->kdkategori->lookupCacheOption($curVal);
			if ($this->kdkategori->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`kdkategori`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->kdkategori->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->kdkategori->ViewValue = $this->kdkategori->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->kdkategori->ViewValue = $this->kdkategori->CurrentValue;
				}
			}
		} else {
			$this->kdkategori->ViewValue = NULL;
		}
		$this->kdkategori->ViewCustomAttributes = "";

		// kerjasama
		$this->kerjasama->ViewValue = $this->kerjasama->CurrentValue;
		$curVal = strval($this->kerjasama->CurrentValue);
		if ($curVal != "") {
			$this->kerjasama->ViewValue = $this->kerjasama->lookupCacheOption($curVal);
			if ($this->kerjasama->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`idp`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->kerjasama->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->kerjasama->ViewValue = $this->kerjasama->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->kerjasama->ViewValue = $this->kerjasama->CurrentValue;
				}
			}
		} else {
			$this->kerjasama->ViewValue = NULL;
		}
		$this->kerjasama->ViewCustomAttributes = "";

		// tglpelak1
		$this->tglpelak1->ViewValue = $this->tglpelak1->CurrentValue;
		$this->tglpelak1->ViewCustomAttributes = "";

		// targetpes1
		$this->targetpes1->ViewValue = $this->targetpes1->CurrentValue;
		$this->targetpes1->ViewCustomAttributes = "";

		// tglpelak2
		$this->tglpelak2->ViewValue = $this->tglpelak2->CurrentValue;
		$this->tglpelak2->ViewCustomAttributes = "";

		// targetpes2
		$this->targetpes2->ViewValue = $this->targetpes2->CurrentValue;
		$this->targetpes2->ViewCustomAttributes = "";

		// tglpelak3
		$this->tglpelak3->ViewValue = $this->tglpelak3->CurrentValue;
		$this->tglpelak3->ViewCustomAttributes = "";

		// targetpes3
		$this->targetpes3->ViewValue = $this->targetpes3->CurrentValue;
		$this->targetpes3->ViewCustomAttributes = "";

		// tglpelak4
		$this->tglpelak4->ViewValue = $this->tglpelak4->CurrentValue;
		$this->tglpelak4->ViewCustomAttributes = "";

		// targetpes4
		$this->targetpes4->ViewValue = $this->targetpes4->CurrentValue;
		$this->targetpes4->ViewCustomAttributes = "";

		// tglpelak5
		$this->tglpelak5->ViewValue = $this->tglpelak5->CurrentValue;
		$this->tglpelak5->ViewCustomAttributes = "";

		// targetpes5
		$this->targetpes5->ViewValue = $this->targetpes5->CurrentValue;
		$this->targetpes5->ViewCustomAttributes = "";

		// tglpelak6
		$this->tglpelak6->ViewValue = $this->tglpelak6->CurrentValue;
		$this->tglpelak6->ViewCustomAttributes = "";

		// targetpes6
		$this->targetpes6->ViewValue = $this->targetpes6->CurrentValue;
		$this->targetpes6->ViewCustomAttributes = "";

		// tglpelak7
		$this->tglpelak7->ViewValue = $this->tglpelak7->CurrentValue;
		$this->tglpelak7->ViewCustomAttributes = "";

		// targetpes7
		$this->targetpes7->ViewValue = $this->targetpes7->CurrentValue;
		$this->targetpes7->ViewCustomAttributes = "";

		// tglpelak8
		$this->tglpelak8->ViewValue = $this->tglpelak8->CurrentValue;
		$this->tglpelak8->ViewCustomAttributes = "";

		// targetpes8
		$this->targetpes8->ViewValue = $this->targetpes8->CurrentValue;
		$this->targetpes8->ViewCustomAttributes = "";

		// ctid
		$this->ctid->LinkCustomAttributes = "";
		$this->ctid->HrefValue = "";
		$this->ctid->TooltipValue = "";

		// rkid
		$this->rkid->LinkCustomAttributes = "";
		$this->rkid->HrefValue = "";
		$this->rkid->TooltipValue = "";

		// area
		$this->area->LinkCustomAttributes = "";
		$this->area->HrefValue = "";
		$this->area->TooltipValue = "";

		// jenispel
		$this->jenispel->LinkCustomAttributes = "";
		$this->jenispel->HrefValue = "";
		$this->jenispel->TooltipValue = "";

		// kdkategori
		$this->kdkategori->LinkCustomAttributes = "";
		$this->kdkategori->HrefValue = "";
		$this->kdkategori->TooltipValue = "";

		// kerjasama
		$this->kerjasama->LinkCustomAttributes = "";
		$this->kerjasama->HrefValue = "";
		$this->kerjasama->TooltipValue = "";

		// tglpelak1
		$this->tglpelak1->LinkCustomAttributes = "";
		$this->tglpelak1->HrefValue = "";
		$this->tglpelak1->TooltipValue = "";

		// targetpes1
		$this->targetpes1->LinkCustomAttributes = "";
		$this->targetpes1->HrefValue = "";
		$this->targetpes1->TooltipValue = "";

		// tglpelak2
		$this->tglpelak2->LinkCustomAttributes = "";
		$this->tglpelak2->HrefValue = "";
		$this->tglpelak2->TooltipValue = "";

		// targetpes2
		$this->targetpes2->LinkCustomAttributes = "";
		$this->targetpes2->HrefValue = "";
		$this->targetpes2->TooltipValue = "";

		// tglpelak3
		$this->tglpelak3->LinkCustomAttributes = "";
		$this->tglpelak3->HrefValue = "";
		$this->tglpelak3->TooltipValue = "";

		// targetpes3
		$this->targetpes3->LinkCustomAttributes = "";
		$this->targetpes3->HrefValue = "";
		$this->targetpes3->TooltipValue = "";

		// tglpelak4
		$this->tglpelak4->LinkCustomAttributes = "";
		$this->tglpelak4->HrefValue = "";
		$this->tglpelak4->TooltipValue = "";

		// targetpes4
		$this->targetpes4->LinkCustomAttributes = "";
		$this->targetpes4->HrefValue = "";
		$this->targetpes4->TooltipValue = "";

		// tglpelak5
		$this->tglpelak5->LinkCustomAttributes = "";
		$this->tglpelak5->HrefValue = "";
		$this->tglpelak5->TooltipValue = "";

		// targetpes5
		$this->targetpes5->LinkCustomAttributes = "";
		$this->targetpes5->HrefValue = "";
		$this->targetpes5->TooltipValue = "";

		// tglpelak6
		$this->tglpelak6->LinkCustomAttributes = "";
		$this->tglpelak6->HrefValue = "";
		$this->tglpelak6->TooltipValue = "";

		// targetpes6
		$this->targetpes6->LinkCustomAttributes = "";
		$this->targetpes6->HrefValue = "";
		$this->targetpes6->TooltipValue = "";

		// tglpelak7
		$this->tglpelak7->LinkCustomAttributes = "";
		$this->tglpelak7->HrefValue = "";
		$this->tglpelak7->TooltipValue = "";

		// targetpes7
		$this->targetpes7->LinkCustomAttributes = "";
		$this->targetpes7->HrefValue = "";
		$this->targetpes7->TooltipValue = "";

		// tglpelak8
		$this->tglpelak8->LinkCustomAttributes = "";
		$this->tglpelak8->HrefValue = "";
		$this->tglpelak8->TooltipValue = "";

		// targetpes8
		$this->targetpes8->LinkCustomAttributes = "";
		$this->targetpes8->HrefValue = "";
		$this->targetpes8->TooltipValue = "";

		// Call Row Rendered event
		$this->Row_Rendered();

		// Save data for Custom Template
		$this->Rows[] = $this->customTemplateFieldValues();
	}

	// Render edit row values
	public function renderEditRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// ctid
		$this->ctid->EditAttrs["class"] = "form-control";
		$this->ctid->EditCustomAttributes = "";
		$this->ctid->EditValue = $this->ctid->CurrentValue;
		$this->ctid->ViewCustomAttributes = "";

		// rkid
		$this->rkid->EditAttrs["class"] = "form-control";
		$this->rkid->EditCustomAttributes = "";
		if ($this->rkid->getSessionValue() != "") {
			$this->rkid->CurrentValue = $this->rkid->getSessionValue();
			$this->rkid->ViewValue = $this->rkid->CurrentValue;
			$this->rkid->ViewCustomAttributes = "";
		} else {
			$this->rkid->EditValue = $this->rkid->CurrentValue;
			$this->rkid->PlaceHolder = RemoveHtml($this->rkid->caption());
		}

		// area
		$this->area->EditAttrs["class"] = "form-control";
		$this->area->EditCustomAttributes = "";
		if ($this->area->getSessionValue() != "") {
			$this->area->CurrentValue = $this->area->getSessionValue();
			if ($this->area->VirtualValue != "") {
				$this->area->ViewValue = $this->area->VirtualValue;
			} else {
				$curVal = strval($this->area->CurrentValue);
				if ($curVal != "") {
					$this->area->ViewValue = $this->area->lookupCacheOption($curVal);
					if ($this->area->ViewValue === NULL) { // Lookup from database
						$filterWrk = "`areaid`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
						$sqlWrk = $this->area->Lookup->getSql(FALSE, $filterWrk, '', $this);
						$rswrk = Conn()->execute($sqlWrk);
						if ($rswrk && !$rswrk->EOF) { // Lookup values found
							$arwrk = [];
							$arwrk[1] = $rswrk->fields('df');
							$arwrk[2] = $rswrk->fields('df2');
							$this->area->ViewValue = $this->area->displayValue($arwrk);
							$rswrk->Close();
						} else {
							$this->area->ViewValue = $this->area->CurrentValue;
						}
					}
				} else {
					$this->area->ViewValue = NULL;
				}
			}
			$this->area->ViewCustomAttributes = "";
		} else {
		}

		// jenispel
		$this->jenispel->EditAttrs["class"] = "form-control";
		$this->jenispel->EditCustomAttributes = "";
		$this->jenispel->EditValue = $this->jenispel->options(TRUE);

		// kdkategori
		$this->kdkategori->EditAttrs["class"] = "form-control";
		$this->kdkategori->EditCustomAttributes = "";

		// kerjasama
		$this->kerjasama->EditAttrs["class"] = "form-control";
		$this->kerjasama->EditCustomAttributes = "";
		$this->kerjasama->EditValue = $this->kerjasama->CurrentValue;
		$this->kerjasama->PlaceHolder = RemoveHtml($this->kerjasama->caption());

		// tglpelak1
		$this->tglpelak1->EditAttrs["class"] = "form-control";
		$this->tglpelak1->EditCustomAttributes = "";
		if (!$this->tglpelak1->Raw)
			$this->tglpelak1->CurrentValue = HtmlDecode($this->tglpelak1->CurrentValue);
		$this->tglpelak1->EditValue = $this->tglpelak1->CurrentValue;
		$this->tglpelak1->PlaceHolder = RemoveHtml($this->tglpelak1->caption());

		// targetpes1
		$this->targetpes1->EditAttrs["class"] = "form-control";
		$this->targetpes1->EditCustomAttributes = "";
		$this->targetpes1->EditValue = $this->targetpes1->CurrentValue;
		$this->targetpes1->PlaceHolder = RemoveHtml($this->targetpes1->caption());

		// tglpelak2
		$this->tglpelak2->EditAttrs["class"] = "form-control";
		$this->tglpelak2->EditCustomAttributes = "";
		if (!$this->tglpelak2->Raw)
			$this->tglpelak2->CurrentValue = HtmlDecode($this->tglpelak2->CurrentValue);
		$this->tglpelak2->EditValue = $this->tglpelak2->CurrentValue;
		$this->tglpelak2->PlaceHolder = RemoveHtml($this->tglpelak2->caption());

		// targetpes2
		$this->targetpes2->EditAttrs["class"] = "form-control";
		$this->targetpes2->EditCustomAttributes = "";
		$this->targetpes2->EditValue = $this->targetpes2->CurrentValue;
		$this->targetpes2->PlaceHolder = RemoveHtml($this->targetpes2->caption());

		// tglpelak3
		$this->tglpelak3->EditAttrs["class"] = "form-control";
		$this->tglpelak3->EditCustomAttributes = "";
		if (!$this->tglpelak3->Raw)
			$this->tglpelak3->CurrentValue = HtmlDecode($this->tglpelak3->CurrentValue);
		$this->tglpelak3->EditValue = $this->tglpelak3->CurrentValue;
		$this->tglpelak3->PlaceHolder = RemoveHtml($this->tglpelak3->caption());

		// targetpes3
		$this->targetpes3->EditAttrs["class"] = "form-control";
		$this->targetpes3->EditCustomAttributes = "";
		$this->targetpes3->EditValue = $this->targetpes3->CurrentValue;
		$this->targetpes3->PlaceHolder = RemoveHtml($this->targetpes3->caption());

		// tglpelak4
		$this->tglpelak4->EditAttrs["class"] = "form-control";
		$this->tglpelak4->EditCustomAttributes = "";
		if (!$this->tglpelak4->Raw)
			$this->tglpelak4->CurrentValue = HtmlDecode($this->tglpelak4->CurrentValue);
		$this->tglpelak4->EditValue = $this->tglpelak4->CurrentValue;
		$this->tglpelak4->PlaceHolder = RemoveHtml($this->tglpelak4->caption());

		// targetpes4
		$this->targetpes4->EditAttrs["class"] = "form-control";
		$this->targetpes4->EditCustomAttributes = "";
		$this->targetpes4->EditValue = $this->targetpes4->CurrentValue;
		$this->targetpes4->PlaceHolder = RemoveHtml($this->targetpes4->caption());

		// tglpelak5
		$this->tglpelak5->EditAttrs["class"] = "form-control";
		$this->tglpelak5->EditCustomAttributes = "";
		if (!$this->tglpelak5->Raw)
			$this->tglpelak5->CurrentValue = HtmlDecode($this->tglpelak5->CurrentValue);
		$this->tglpelak5->EditValue = $this->tglpelak5->CurrentValue;
		$this->tglpelak5->PlaceHolder = RemoveHtml($this->tglpelak5->caption());

		// targetpes5
		$this->targetpes5->EditAttrs["class"] = "form-control";
		$this->targetpes5->EditCustomAttributes = "";
		$this->targetpes5->EditValue = $this->targetpes5->CurrentValue;
		$this->targetpes5->PlaceHolder = RemoveHtml($this->targetpes5->caption());

		// tglpelak6
		$this->tglpelak6->EditAttrs["class"] = "form-control";
		$this->tglpelak6->EditCustomAttributes = "";
		if (!$this->tglpelak6->Raw)
			$this->tglpelak6->CurrentValue = HtmlDecode($this->tglpelak6->CurrentValue);
		$this->tglpelak6->EditValue = $this->tglpelak6->CurrentValue;
		$this->tglpelak6->PlaceHolder = RemoveHtml($this->tglpelak6->caption());

		// targetpes6
		$this->targetpes6->EditAttrs["class"] = "form-control";
		$this->targetpes6->EditCustomAttributes = "";
		$this->targetpes6->EditValue = $this->targetpes6->CurrentValue;
		$this->targetpes6->PlaceHolder = RemoveHtml($this->targetpes6->caption());

		// tglpelak7
		$this->tglpelak7->EditAttrs["class"] = "form-control";
		$this->tglpelak7->EditCustomAttributes = "";
		if (!$this->tglpelak7->Raw)
			$this->tglpelak7->CurrentValue = HtmlDecode($this->tglpelak7->CurrentValue);
		$this->tglpelak7->EditValue = $this->tglpelak7->CurrentValue;
		$this->tglpelak7->PlaceHolder = RemoveHtml($this->tglpelak7->caption());

		// targetpes7
		$this->targetpes7->EditAttrs["class"] = "form-control";
		$this->targetpes7->EditCustomAttributes = "";
		$this->targetpes7->EditValue = $this->targetpes7->CurrentValue;
		$this->targetpes7->PlaceHolder = RemoveHtml($this->targetpes7->caption());

		// tglpelak8
		$this->tglpelak8->EditAttrs["class"] = "form-control";
		$this->tglpelak8->EditCustomAttributes = "";
		if (!$this->tglpelak8->Raw)
			$this->tglpelak8->CurrentValue = HtmlDecode($this->tglpelak8->CurrentValue);
		$this->tglpelak8->EditValue = $this->tglpelak8->CurrentValue;
		$this->tglpelak8->PlaceHolder = RemoveHtml($this->tglpelak8->caption());

		// targetpes8
		$this->targetpes8->EditAttrs["class"] = "form-control";
		$this->targetpes8->EditCustomAttributes = "";
		$this->targetpes8->EditValue = $this->targetpes8->CurrentValue;
		$this->targetpes8->PlaceHolder = RemoveHtml($this->targetpes8->caption());

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Aggregate list row values
	public function aggregateListRowValues()
	{
	}

	// Aggregate list row (for rendering)
	public function aggregateListRow()
	{

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Export data in HTML/CSV/Word/Excel/Email/PDF format
	public function exportDocument($doc, $recordset, $startRec = 1, $stopRec = 1, $exportPageType = "")
	{
		if (!$recordset || !$doc)
			return;
		if (!$doc->ExportCustom) {

			// Write header
			$doc->exportTableHeader();
			if ($doc->Horizontal) { // Horizontal format, write header
				$doc->beginExportRow();
				if ($exportPageType == "view") {
					$doc->exportCaption($this->area);
					$doc->exportCaption($this->jenispel);
					$doc->exportCaption($this->kdkategori);
					$doc->exportCaption($this->kerjasama);
					$doc->exportCaption($this->tglpelak1);
					$doc->exportCaption($this->targetpes1);
					$doc->exportCaption($this->tglpelak2);
					$doc->exportCaption($this->targetpes2);
					$doc->exportCaption($this->tglpelak3);
					$doc->exportCaption($this->targetpes3);
					$doc->exportCaption($this->tglpelak4);
					$doc->exportCaption($this->targetpes4);
					$doc->exportCaption($this->tglpelak5);
					$doc->exportCaption($this->targetpes5);
					$doc->exportCaption($this->tglpelak6);
					$doc->exportCaption($this->targetpes6);
					$doc->exportCaption($this->tglpelak7);
					$doc->exportCaption($this->targetpes7);
					$doc->exportCaption($this->tglpelak8);
					$doc->exportCaption($this->targetpes8);
				} else {
					$doc->exportCaption($this->area);
					$doc->exportCaption($this->jenispel);
					$doc->exportCaption($this->kdkategori);
					$doc->exportCaption($this->kerjasama);
					$doc->exportCaption($this->tglpelak1);
					$doc->exportCaption($this->targetpes1);
					$doc->exportCaption($this->tglpelak2);
					$doc->exportCaption($this->targetpes2);
					$doc->exportCaption($this->tglpelak3);
					$doc->exportCaption($this->targetpes3);
					$doc->exportCaption($this->tglpelak4);
					$doc->exportCaption($this->targetpes4);
					$doc->exportCaption($this->tglpelak5);
					$doc->exportCaption($this->targetpes5);
					$doc->exportCaption($this->tglpelak6);
					$doc->exportCaption($this->targetpes6);
					$doc->exportCaption($this->tglpelak7);
					$doc->exportCaption($this->targetpes7);
					$doc->exportCaption($this->tglpelak8);
					$doc->exportCaption($this->targetpes8);
				}
				$doc->endExportRow();
			}
		}

		// Move to first record
		$recCnt = $startRec - 1;
		if (!$recordset->EOF) {
			$recordset->moveFirst();
			if ($startRec > 1)
				$recordset->move($startRec - 1);
		}
		while (!$recordset->EOF && $recCnt < $stopRec) {
			$recCnt++;
			if ($recCnt >= $startRec) {
				$rowCnt = $recCnt - $startRec + 1;

				// Page break
				if ($this->ExportPageBreakCount > 0) {
					if ($rowCnt > 1 && ($rowCnt - 1) % $this->ExportPageBreakCount == 0)
						$doc->exportPageBreak();
				}
				$this->loadListRowValues($recordset);

				// Render row
				$this->RowType = ROWTYPE_VIEW; // Render view
				$this->resetAttributes();
				$this->renderListRow();
				if (!$doc->ExportCustom) {
					$doc->beginExportRow($rowCnt); // Allow CSS styles if enabled
					if ($exportPageType == "view") {
						$doc->exportField($this->area);
						$doc->exportField($this->jenispel);
						$doc->exportField($this->kdkategori);
						$doc->exportField($this->kerjasama);
						$doc->exportField($this->tglpelak1);
						$doc->exportField($this->targetpes1);
						$doc->exportField($this->tglpelak2);
						$doc->exportField($this->targetpes2);
						$doc->exportField($this->tglpelak3);
						$doc->exportField($this->targetpes3);
						$doc->exportField($this->tglpelak4);
						$doc->exportField($this->targetpes4);
						$doc->exportField($this->tglpelak5);
						$doc->exportField($this->targetpes5);
						$doc->exportField($this->tglpelak6);
						$doc->exportField($this->targetpes6);
						$doc->exportField($this->tglpelak7);
						$doc->exportField($this->targetpes7);
						$doc->exportField($this->tglpelak8);
						$doc->exportField($this->targetpes8);
					} else {
						$doc->exportField($this->area);
						$doc->exportField($this->jenispel);
						$doc->exportField($this->kdkategori);
						$doc->exportField($this->kerjasama);
						$doc->exportField($this->tglpelak1);
						$doc->exportField($this->targetpes1);
						$doc->exportField($this->tglpelak2);
						$doc->exportField($this->targetpes2);
						$doc->exportField($this->tglpelak3);
						$doc->exportField($this->targetpes3);
						$doc->exportField($this->tglpelak4);
						$doc->exportField($this->targetpes4);
						$doc->exportField($this->tglpelak5);
						$doc->exportField($this->targetpes5);
						$doc->exportField($this->tglpelak6);
						$doc->exportField($this->targetpes6);
						$doc->exportField($this->tglpelak7);
						$doc->exportField($this->targetpes7);
						$doc->exportField($this->tglpelak8);
						$doc->exportField($this->targetpes8);
					}
					$doc->endExportRow($rowCnt);
				}
			}

			// Call Row Export server event
			if ($doc->ExportCustom)
				$this->Row_Export($recordset->fields);
			$recordset->moveNext();
		}
		if (!$doc->ExportCustom) {
			$doc->exportTableFooter();
		}
	}

	// Get file data
	public function getFileData($fldparm, $key, $resize, $width = 0, $height = 0)
	{

		// No binary fields
		return FALSE;
	}

	// Write Audit Trail start/end for grid update
	public function writeAuditTrailDummy($typ)
	{
		$table = 't_coachingtahapan';
		$usr = CurrentUserName();
		WriteAuditTrail("log", DbCurrentDateTime(), ScriptName(), $usr, $typ, $table, "", "", "", "");
	}

	// Write Audit Trail (add page)
	public function writeAuditTrailOnAdd(&$rs)
	{
		global $Language;
		if (!$this->AuditTrailOnAdd)
			return;
		$table = 't_coachingtahapan';

		// Get key value
		$key = "";
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rs['ctid'];

		// Write Audit Trail
		$dt = DbCurrentDateTime();
		$id = ScriptName();
		$usr = CurrentUserName();
		foreach (array_keys($rs) as $fldname) {
			if (array_key_exists($fldname, $this->fields) && $this->fields[$fldname]->DataType != DATATYPE_BLOB) { // Ignore BLOB fields
				if ($this->fields[$fldname]->HtmlTag == "PASSWORD") {
					$newvalue = $Language->phrase("PasswordMask"); // Password Field
				} elseif ($this->fields[$fldname]->DataType == DATATYPE_MEMO) {
					if (Config("AUDIT_TRAIL_TO_DATABASE"))
						$newvalue = $rs[$fldname];
					else
						$newvalue = "[MEMO]"; // Memo Field
				} elseif ($this->fields[$fldname]->DataType == DATATYPE_XML) {
					$newvalue = "[XML]"; // XML Field
				} else {
					$newvalue = $rs[$fldname];
				}
				WriteAuditTrail("log", $dt, $id, $usr, "A", $table, $fldname, $key, "", $newvalue);
			}
		}
	}

	// Write Audit Trail (edit page)
	public function writeAuditTrailOnEdit(&$rsold, &$rsnew)
	{
		global $Language;
		if (!$this->AuditTrailOnEdit)
			return;
		$table = 't_coachingtahapan';

		// Get key value
		$key = "";
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rsold['ctid'];

		// Write Audit Trail
		$dt = DbCurrentDateTime();
		$id = ScriptName();
		$usr = CurrentUserName();
		foreach (array_keys($rsnew) as $fldname) {
			if (array_key_exists($fldname, $this->fields) && array_key_exists($fldname, $rsold) && $this->fields[$fldname]->DataType != DATATYPE_BLOB) { // Ignore BLOB fields
				if ($this->fields[$fldname]->DataType == DATATYPE_DATE) { // DateTime field
					$modified = (FormatDateTime($rsold[$fldname], 0) != FormatDateTime($rsnew[$fldname], 0));
				} else {
					$modified = !CompareValue($rsold[$fldname], $rsnew[$fldname]);
				}
				if ($modified) {
					if ($this->fields[$fldname]->HtmlTag == "PASSWORD") { // Password Field
						$oldvalue = $Language->phrase("PasswordMask");
						$newvalue = $Language->phrase("PasswordMask");
					} elseif ($this->fields[$fldname]->DataType == DATATYPE_MEMO) { // Memo field
						if (Config("AUDIT_TRAIL_TO_DATABASE")) {
							$oldvalue = $rsold[$fldname];
							$newvalue = $rsnew[$fldname];
						} else {
							$oldvalue = "[MEMO]";
							$newvalue = "[MEMO]";
						}
					} elseif ($this->fields[$fldname]->DataType == DATATYPE_XML) { // XML field
						$oldvalue = "[XML]";
						$newvalue = "[XML]";
					} else {
						$oldvalue = $rsold[$fldname];
						$newvalue = $rsnew[$fldname];
					}
					WriteAuditTrail("log", $dt, $id, $usr, "U", $table, $fldname, $key, $oldvalue, $newvalue);
				}
			}
		}
	}

	// Write Audit Trail (delete page)
	public function writeAuditTrailOnDelete(&$rs)
	{
		global $Language;
		if (!$this->AuditTrailOnDelete)
			return;
		$table = 't_coachingtahapan';

		// Get key value
		$key = "";
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rs['ctid'];

		// Write Audit Trail
		$dt = DbCurrentDateTime();
		$id = ScriptName();
		$curUser = CurrentUserName();
		foreach (array_keys($rs) as $fldname) {
			if (array_key_exists($fldname, $this->fields) && $this->fields[$fldname]->DataType != DATATYPE_BLOB) { // Ignore BLOB fields
				if ($this->fields[$fldname]->HtmlTag == "PASSWORD") {
					$oldvalue = $Language->phrase("PasswordMask"); // Password Field
				} elseif ($this->fields[$fldname]->DataType == DATATYPE_MEMO) {
					if (Config("AUDIT_TRAIL_TO_DATABASE"))
						$oldvalue = $rs[$fldname];
					else
						$oldvalue = "[MEMO]"; // Memo field
				} elseif ($this->fields[$fldname]->DataType == DATATYPE_XML) {
					$oldvalue = "[XML]"; // XML field
				} else {
					$oldvalue = $rs[$fldname];
				}
				WriteAuditTrail("log", $dt, $id, $curUser, "D", $table, $fldname, $key, $oldvalue, "");
			}
		}
	}

	// Table level events
	// Recordset Selecting event
	function Recordset_Selecting(&$filter) {

		// Enter your code here
	}

	// Recordset Selected event
	function Recordset_Selected(&$rs) {

		//echo "Recordset Selected";
	}

	// Recordset Search Validated event
	function Recordset_SearchValidated() {

		// Example:
		//$this->MyField1->AdvancedSearch->SearchValue = "your search criteria"; // Search value

	}

	// Recordset Searching event
	function Recordset_Searching(&$filter) {

		// Enter your code here
	}

	// Row_Selecting event
	function Row_Selecting(&$filter) {

		// Enter your code here
	}

	// Row Selected event
	function Row_Selected(&$rs) {

		//echo "Row Selected";
	}

	// Row Inserting event
	function Row_Inserting($rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Inserted event
	function Row_Inserted($rsold, &$rsnew) {

		//echo "Row Inserted"
	}

	// Row Updating event
	function Row_Updating($rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Updated event
	function Row_Updated($rsold, &$rsnew) {

		//echo "Row Updated";
	}

	// Row Update Conflict event
	function Row_UpdateConflict($rsold, &$rsnew) {

		// Enter your code here
		// To ignore conflict, set return value to FALSE

		return TRUE;
	}

	// Grid Inserting event
	function Grid_Inserting() {

		// Enter your code here
		// To reject grid insert, set return value to FALSE

		return TRUE;
	}

	// Grid Inserted event
	function Grid_Inserted($rsnew) {

		//echo "Grid Inserted";
	}

	// Grid Updating event
	function Grid_Updating($rsold) {

		// Enter your code here
		// To reject grid update, set return value to FALSE

		return TRUE;
	}

	// Grid Updated event
	function Grid_Updated($rsold, $rsnew) {

		//echo "Grid Updated";
	}

	// Row Deleting event
	function Row_Deleting(&$rs) {

		// Enter your code here
		// To cancel, set return value to False

		return TRUE;
	}

	// Row Deleted event
	function Row_Deleted(&$rs) {

		//echo "Row Deleted";
	}

	// Email Sending event
	function Email_Sending($email, &$args) {

		//var_dump($email); var_dump($args); exit();
		return TRUE;
	}

	// Lookup Selecting event
	function Lookup_Selecting($fld, &$filter) {

		//var_dump($fld->Name, $fld->Lookup, $filter); // Uncomment to view the filter
		// Enter your code here

	}

	// Row Rendering event
	function Row_Rendering() {

		// Enter your code here
	}

	// Row Rendered event
	function Row_Rendered() {

		// To view properties of field class, use:
		//var_dump($this-><FieldName>);

	}

	// User ID Filtering event
	function UserID_Filtering(&$filter) {

		// Enter your code here
	}
}
?>