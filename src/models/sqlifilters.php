<?php

function get_filters()
{
    return array(
        array(
            "id" => "40",
            "rule" => "(?:\\)\\s*when\\s*\\d+\\s*then)|(?:\"\\s*(?:#|--|{))|(?:\\\/\\*!\\s?\\d+)|(?:ch(?:a)?r\\s*\\(\\s*\\d)|(?:(?:(n?and|x?or|not)\\s+|\\|\\||\\&\\&)\\s*\\w+\\()",
            "description" => "Detects MySQL comments, conditions and ch(a)r injections",
            "tags" => array(
                "tag" => array(
                    "sqli",
                    "id",
                    "lfi"
                )
            ),
            "impact" => "6"
        ),
        array(
            "id" => "41",
            "rule" => "(?:[\\s()]case\\s*\\()|(?:\\)\\s*like\\s*\\()|(?:having\\s*[^\\s]+\\s*[^\\w\\s])|(?:if\\s?\\([\\d\\w]\\s*[=<>~])",
            "description" => "Detects conditional SQL injection attempts",
            "tags" => "sqli",
            "impact" => "6"
        ),
        array(
            "id" => "42",
            "rule" => "(?:\"\\s*or\\s*\"?\\d)|(?:\\\\x(?:23|27|3d))|(?:^.?\"$)|(?:(?:^[\"\\\\]*(?:[\\d\"]+|[^\"]+\"))+\\s*(?:n?and|x?or|not|\\|\\||\\&\\&)\\s*[\\w\"[+&!@(),.-])|(?:[^\\w\\s]\\w+\\s*[|-]\\s*\"\\s*\\w)|(?:@\\w+\\s+(and|or)\\s*[\"\\d]+)|(?:@[\\w-]+\\s(and|or)\\s*[^\\w\\s])|(?:[^\\w\\s:]\\s*\\d\\W+[^\\w\\s]\\s*\".)|(?:\\Winformation_schema|table_name\\W)",
            "description" => "Detects classic SQL injection probings 1/2",
            "tags" => "sqli",
            "impact" => "6"
        ),
        array(
            "id" => "43",
            "rule" => "(?:\"\\s*\\*.+(?:or|id)\\W*\"\\d)|(?:\\^\")|(?:^[\\w\\s\"-]+(?<=and\\s)(?<=or\\s)(?<=xor\\s)(?<=nand\\s)(?<=not\\s)(?<=\\|\\|)(?<=\\&\\&)\\w+\\()|(?:\"[\\s\\d]*[^\\w\\s]+\\W*\\d\\W*.*[\"\\d])|(?:\"\\s*[^\\w\\s?]+\\s*[^\\w\\s]+\\s*\")|(?:\"\\s*[^\\w\\s]+\\s*[\\W\\d].*(?:#|--))|(?:\".*\\*\\s*\\d)|(?:\"\\s*or\\s[^\\d]+[\\w-]+.*\\d)|(?:[()*<>%+-][\\w-]+[^\\w\\s]+\"[^,])",
            "description" => "Detects classic SQL injection probings 2/2",
            "tags" => "sqli",
            "impact" => "6"
        ),
        array(
            "id" => "44",
            "rule" => "(?:\\d\"\\s+\"\\s+\\d)|(?:^admin\\s*\"|(\\\/\\*)+\"+\\s?(?:--|#|\\\/\\*|{)?)|(?:\"\\s*or[\\w\\s-]+\\s*[+<>=(),-]\\s*[\\d\"])|(?:\"\\s*[^\\w\\s]?=\\s*\")|(?:\"\\W*[+=]+\\W*\")|(?:\"\\s*[!=|][\\d\\s!=+-]+.*[\"(].*$)|(?:\"\\s*[!=|][\\d\\s!=]+.*\\d+$)|(?:\"\\s*like\\W+[\\w\"(])|(?:\\sis\\s*0\\W)|(?:where\\s[\\s\\w\\.,-]+\\s=)|(?:\"[<>~]+\")",
            "description" => "Detects basic SQL authentication bypass attempts 1/3",
            "tags" => "sqli",
            "impact" => "7"
        ),
        array(
            "id" => "45",
            "rule" => "(?:union\\s*(?:all|distinct|[(!@]*)\\s*[([]*\\s*select)|(?:\\w+\\s+like\\s+\\\")|(?:like\\s*\"\\%)|(?:\"\\s*like\\W*[\"\\d])|(?:\"\\s*(?:n?and|x?or|not |\\|\\||\\&\\&)\\s+[\\s\\w]+=\\s*\\w+\\s*having)|(?:\"\\s*\\*\\s*\\w+\\W+\")|(?:\"\\s*[^?\\w\\s=.,;)(]+\\s*[(@\"]*\\s*\\w+\\W+\\w)|(?:select\\s*[\\[\\]()\\s\\w\\.,\"-]+from)|(?:find_in_set\\s*\\()",
            "description" => "Detects basic SQL authentication bypass attempts 2/3",
            "tags" => "sqli",
            "impact" => "7"
        ),
        array(
            "id" => "46",
            "rule" => "(?:in\\s*\\(+\\s*select)|(?:(?:n?and|x?or|not |\\|\\||\\&\\&)\\s+[\\s\\w+]+(?:regexp\\s*\\(|sounds\\s+like\\s*\"|[=\\d]+x))|(\"\\s*\\d\\s*(?:--|#))|(?:\"[%&<>^=]+\\d\\s*(=|or))|(?:\"\\W+[\\w+-]+\\s*=\\s*\\d\\W+\")|(?:\"\\s*is\\s*\\d.+\"?\\w)|(?:\"\\|?[\\w-]{3,}[^\\w\\s.,]+\")|(?:\"\\s*is\\s*[\\d.]+\\s*\\W.*\")",
            "description" => "Detects basic SQL authentication bypass attempts 3/3",
            "tags" => "sqli",
            "impact" => "7"
        ),
        array(
            "id" => "47",
            "rule" => "(?:[\\d\\W]\\s+as\\s*[\"\\w]+\\s*from)|(?:^[\\W\\d]+\\s*(?:union|select|create|rename|truncate|load|alter|delete|update|insert|desc))|(?:(?:select|create|rename|truncate|load|alter|delete|update|insert|desc)\\s+(?:(?:group_)concat|char|load_file)\\s?\\(?)|(?:end\\s*\\);)|(\"\\s+regexp\\W)|(?:[\\s(]load_file\\s*\\()",
            "description" => "Detects concatenated basic SQL injection and SQLLFI attempts",
            "tags" => "sqli",
            "impact" => "5"
        ),
        array(
            "id" => "48",
            "rule" => "(?:@.+=\\s*\\(\\s*select)|(?:\\d+\\s*or\\s*\\d+\\s*[\\-+])|(?:\\\/\\w+;?\\s+(?:having|and|or|select)\\W)|(?:\\d\\s+group\\s+by.+\\()|(?:(?:;|#|--)\\s*(?:drop|alter))|(?:(?:;|#|--)\\s*(?:update|insert)\\s*\\w{2,})|(?:[^\\w]SET\\s*@\\w+)|(?:(?:n?and|x?or|not |\\|\\||\\&\\&)[\\s(]+\\w+[\\s)]*[!=+]+[\\s\\d]*[\"=()])",
            "description" => "Detects chained SQL injection attempts 1/2",
            "tags" => "sqli",
            "impact" => "6"
        ),
        array(
            "id" => "49",
            "rule" => "(?:\"\\s+and\\s*=\\W)|(?:\\(\\s*select\\s*\\w+\\s*\\()|(?:\\*\\\/from)|(?:\\+\\s*\\d+\\s*\\+\\s*@)|(?:\\w\"\\s*(?:[-+=|@]+\\s*)+[\\d(])|(?:coalesce\\s*\\(|@@\\w+\\s*[^\\w\\s])|(?:\\W!+\"\\w)|(?:\";\\s*(?:if|while|begin))|(?:\"[\\s\\d]+=\\s*\\d)|(?:order\\s+by\\s+if\\w*\\s*\\()|(?:[\\s(]+case\\d*\\W.+[tw]hen[\\s(])",
            "description" => "Detects chained SQL injection attempts 2/2",
            "tags" => "sqli",
            "impact" => "6"
        ),
        array(
            "id" => "50",
            "rule" => "(?:(select|;)\\s+(?:benchmark|if|sleep)\\s*?\\(\\s*\\(?\\s*\\w+)",
            "description" => "Detects SQL benchmark and sleep injection attempts including conditional queries",
            "tags" => "sqli",
            "impact" => "4"
        ),
        array(
            "id" => "51",
            "rule" => "(?:create\\s+function\\s+\\w+\\s+returns)|(?:;\\s*(?:select|create|rename|truncate|load|alter|delete|update|insert|desc)\\s*[\\[(]?\\w{2,})",
            "description" => "Detects MySQL UDF injection and other data/structure manipulation attempts",
            "tags" => "sqli",
            "impact" => "6"
        ),
        array(
            "id" => "52",
            "rule" => "(?:alter\\s*\\w+.*character\\s+set\\s+\\w+)|(\";\\s*waitfor\\s+time\\s+\")|(?:\";.*:\\s*goto)",
            "description" => "Detects MySQL charset switch and MSSQL DoS attempts",
            "tags" => "sqli",
            "impact" => "6"
        ),
        array(
            "id" => "53",
            "rule" => "(?:procedure\\s+analyse\\s*\\()|(?:;\\s*(declare|open)\\s+[\\w-]+)|(?:create\\s+(procedure|function)\\s*\\w+\\s*\\(\\s*\\)\\s*-)|(?:declare[^\\w]+[@#]\\s*\\w+)|(exec\\s*\\(\\s*@)",
            "description" => "Detects MySQL and PostgreSQL stored procedure/function injections",
            "tags" => "sqli",
            "impact" => "7"
        ),
        array(
            "id" => "54",
            "rule" => "(?:select\\s*pg_sleep)|(?:waitfor\\s*delay\\s?\"+\\s?\\d)|(?:;\\s*shutdown\\s*(?:;|--|#|\\\/\\*|{))",
            "description" => "Detects Postgres pg_sleep injection, waitfor delay attacks and database shutdown attempts",
            "tags" => "sqli",
            "impact" => "5"
        ),
        array(
            "id" => "55",
            "rule" => "(?:\\sexec\\s+xp_cmdshell)|(?:\"\\s*!\\s*[\"\\w])|(?:from\\W+information_schema\\W)|(?:(?:(?:current_)?user|database|schema|connection_id)\\s*\\([^\\)]*)|(?:\";?\\s*(?:select|union|having)\\s*[^\\s])|(?:\\wiif\\s*\\()|(?:exec\\s+master\\.)|(?:union select @)|(?:union[\\w(\\s]*select)|(?:select.*\\w?user\\()|(?:into[\\s+]+(?:dump|out)file\\s*\")",
            "description" => "Detects MSSQL code execution and information gathering attempts",
            "tags" => "sqli",
            "impact" => "5"
        ),
        array(
            "id" => "56",
            "rule" => "(?:merge.*using\\s*\\()|(execute\\s*immediate\\s*\")|(?:\\W+\\d*\\s*having\\s*[^\\s\\-])|(?:match\\s*[\\w(),+-]+\\s*against\\s*\\()",
            "description" => "Detects MATCH AGAINST, MERGE, EXECUTE IMMEDIATE and HAVING injections",
            "tags" => "sqli",
            "impact" => "5"
        ),
        array(
            "id" => "57",
            "rule" => "(?:,.*[)\\da-f\"]\"(?:\".*\"|\\Z|[^\"]+))|(?:\\Wselect.+\\W*from)|((?:select|create|rename|truncate|load|alter|delete|update|insert|desc)\\s*\\(\\s*space\\s*\\()",
            "description" => "Detects MySQL comment-/space-obfuscated injections and backtick termination",
            "tags" => "sqli",
            "impact" => "5"
        ),
        array(
            "id" => "70",
            "rule" => "(?:\\[\\$(?:ne|eq|lte?|gte?|n?in|mod|all|size|exists|type|slice|or)\\])",
            "description" => "Finds basic MongoDB SQL injection attempts",
            "tags" => "sqli",
            "impact" => "4"
        ),
        array(
            "id" => "72",
            "rule" => "(?:(sleep\\((\\s*)(\\d*)(\\s*)\\)|benchmark\\((.*)\\,(.*)\\)))",
            "description" => "Detects blind sqli tests using sleep() or benchmark().",
            "tags" => "sqli",
            "impact" => "4"
        ),
        array(
            "id" => "76",
            "rule" => "(?:(union(.*)select(.*)from))",
            "description" => "Looking for basic sql injection. Common attack string for mysql, oracle and others.",
            "tags" => "sqli",
            "impact" => "3"
        ),
        array(
            "id" => "77",
            "rule" => "(?:^(-0000023456|4294967295|4294967296|2147483648|2147483647|0000012345|-2147483648|-2147483649|0000023456|2.2250738585072007e-308|1e309)$)",
            "description" => "Looking for intiger overflow attacks, these are taken from skipfish, except 2.2250738585072007e-308 is the \"magic number\" crash",
            "tags" => "sqli",
            "impact" => "3"
        )
    );
}
