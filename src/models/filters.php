<?php

function get_filters()
{
    return array(
        array(
            "id" => "102",
            "rule" => "((UNION ALL SELECT (\d,*)+(\s|#|--)+))|((UNION ALL SELECT 'INJ'\|\|'ECT'\|\|'XXX'(,*\d,*)*(\s|#|--)+))",
            "description" => "Union select ALL SQLi detected, trying to access column values from a database table",
            "tag" => "sqli",
            "impact" => "6"
        ),
        array(
            "id" => "100",
            "rule" => "((( OR | HAVING | AND | AS INJECTX WHERE | WHERE )([\w\W]+=[\w\W]+)( |--|#))| ORDER BY [\w\W]+)",
            "description" => "Error based SQLi Detected",
            "tag" => "sqli",
            "impact" => "6"
        ),
        array(
            "id" => "40",
            "rule" => "(?:\)\s*when\s*\d+\s*then)|(?:\"\s*(?:#|--|{))|(?:\/\*!\s?\d+)|(?:char\s*\(\s*\d)|(?:(?:(n?and|x?or|not)\s+|&\&)\s*\w+\()",
            "description" => "Detects MySQL comments, conditions and ch(a)r injections",
            "tag" => "sqli",
            "impact" => "6"
        ),
        array(
            "id" => "41",
            "rule" => "(?:[\\s()]case\\s*\\()|(?:\\)\\s*like\\s*\\()|(?:having\\s*[^\\s]+\\s*[^\\w\\s])|(?:if\\s?\\([\\d\\w]\\s*[=<>~])",
            "description" => "Detects conditional SQL injection attempts",
            "tag" => "sqli",
            "impact" => "6"
        ),
        array(
            "id" => "42",
            "rule" => "(?:\WFROM information_schema.(tables|columns))",
            "description" => "Detects information_schema asccess injection",
            "tag" => "sqli",
            "impact" => "6"
        ),
        array(
            "id" => "44",
            "rule" => "(?:\\d\"\\s+\"\\s+\\d)|(?:^admin\\s*\"|(\\\/\\*)+\"+\\s?(?:--|#|\\\/\\*|{)?)|(?:\"\\s*or[\\w\\s-]+\\s*[+<>=(),-]\\s*[\\d\"])|(?:\"\\s*[^\\w\\s]?=\\s*\")|(?:\"\\W*[+=]+\\W*\")|(?:\"\\s*[!=|][\\d\\s!=+-]+.*[\"(].*$)|(?:\"\\s*[!=|][\\d\\s!=]+.*\\d+$)|(?:\"\\s*like\\W+[\\w\"(])|(?:\\sis\\s*0\\W)|(?:where\\s[\\s\\w\\.,-]+\\s=)|(?:\"[<>~]+\")",
            "description" => "Detects basic SQL authentication bypass attempts 1/3",
            "tag" => "sqli",
            "impact" => "7"
        ),
        array(
            "id" => "46",
            "rule" => "(?:in\\s*\\(+\\s*select)|(?:(?:n?and|x?or|not |\\|\\||\\&\\&)\\s+[\\s\\w+]+(?:regexp\\s*\\(|sounds\\s+like\\s*\"|[=\\d]+x))|(\"\\s*\\d\\s*(?:--|#))|(?:\"[%&<>^=]+\\d\\s*(=|or))|(?:\"\\W+[\\w+-]+\\s*=\\s*\\d\\W+\")|(?:\"\\s*is\\s*\\d.+\"?\\w)|(?:\"\\|?[\\w-]{3,}[^\\w\\s.,]+\")|(?:\"\\s*is\\s*[\\d.]+\\s*\\W.*\")",
            "description" => "Detects basic SQL authentication bypass attempts 3/3",
            "tag" => "sqli",
            "impact" => "7"
        ),
        array(
            "id" => "48",
            "rule" => "(?:@.+=\\s*\\(\\s*select)|(?:\\d+\\s*or\\s*\\d+\\s*[\\-+])|(?:\\\/\\w+;?\\s+(?:having|and|or|select)\\W)|(?:\\d\\s+group\\s+by.+\\()|(?:(?:;|#|--)\\s*(?:drop|alter))|(?:(?:;|#|--)\\s*(?:update|insert)\\s*\\w{2,})|(?:[^\\w]SET\\s*@\\w+)|(?:(?:n?and|x?or|not |\\|\\||\\&\\&)[\\s(]+\\w+[\\s)]*[!=+]+[\\s\\d]*[\"=()])",
            "description" => "Detects chained SQL injection attempts 1/2",
            "tag" => "sqli",
            "impact" => "6"
        ),
        array(
            "id" => "49",
            "rule" => "(?:\"\\s+and\\s*=\\W)|(?:\\(\\s*select\\s*\\w+\\s*\\()|(?:\\*\\\/from)|(?:\\+\\s*\\d+\\s*\\+\\s*@)|(?:\\w\"\\s*(?:[-+=|@]+\\s*)+[\\d(])|(?:coalesce\\s*\\(|@@\\w+\\s*[^\\w\\s])|(?:\\W!+\"\\w)|(?:\";\\s*(?:if|while|begin))|(?:\"[\\s\\d]+=\\s*\\d)|(?:order\\s+by\\s+if\\w*\\s*\\()|(?:[\\s(]+case\\d*\\W.+[tw]hen[\\s(])",
            "description" => "Detects chained SQL injection attempts 2/2",
            "tag" => "sqli",
            "impact" => "6"
        ),
        array(
            "id" => "50",
            "rule" => "(?:(select|;)\s+(?:benchmark|if|sleep)\s*?\\(\s*\\(?\s*\w+)",
            "description" => "Detects SQL benchmark and sleep injection attempts including conditional queries",
            "tag" => "sqli",
            "impact" => "4"
        ),
        array(
            "id" => "51",
            "rule" => "(?:create\\s+function\\s+\\w+\\s+returns)|(?:;\\s*(?:select|create|rename|truncate|load|alter|delete|update|insert|desc)\\s*[\\[(]?\\w{2,})",
            "description" => "Detects MySQL UDF injection and other data/structure manipulation attempts",
            "tag" => "sqli",
            "impact" => "6"
        ),
        array(
            "id" => "52",
            "rule" => "(?:alter\\s*\\w+.*character\\s+set\\s+\\w+)|(\";\\s*waitfor\\s+time\\s+\")|(?:\";.*:\\s*goto)",
            "description" => "Detects MySQL charset switch and MSSQL DoS attempts",
            "tag" => "sqli",
            "impact" => "6"
        ),
        array(
            "id" => "53",
            "rule" => "(?:procedure\\s+analyse\\s*\\()|(?:;\\s*(declare|open)\\s+[\\w-]+)|(?:create\\s+(procedure|function)\\s*\\w+\\s*\\(\\s*\\)\\s*-)|(?:declare[^\\w]+[@#]\\s*\\w+)|(exec\\s*\\(\\s*@)",
            "description" => "Detects MySQL and PostgreSQL stored procedure/function injections",
            "tag" => "sqli",
            "impact" => "7"
        ),
        array(
            "id" => "54",
            "rule" => "(?:select\\s*pg_sleep)|(?:waitfor\\s*delay\\s?\"+\\s?\\d)|(?:;\\s*shutdown\\s*(?:;|--|#|\\\/\\*|{))",
            "description" => "Detects Postgres pg_sleep injection, waitfor delay attacks and database shutdown attempts",
            "tag" => "sqli",
            "impact" => "5"
        ),

        array(
            "id" => "56",
            "rule" => "(?:merge.*using\\s*\\()|(execute\\s*immediate\\s*\")|(?:\\W+\\d*\\s*having\\s*[^\\s\\-])|(?:match\\s*[\\w(),+-]+\\s*against\\s*\\()",
            "description" => "Detects MATCH AGAINST, MERGE, EXECUTE IMMEDIATE and HAVING injections",
            "tag" => "sqli",
            "impact" => "5"
        ),
        array(
            "id" => "70",
            "rule" => "(?:\\[\\$(?:ne|eq|lte?|gte?|n?in|mod|all|size|exists|type|slice|or)\\])",
            "description" => "Finds basic MongoDB SQL injection attempts",
            "tag" => "sqli",
            "impact" => "4"
        ),
        array(
            "id" => "72",
            "rule" => "(?:(sleep\((\s*)(\d*)(\s*)\)|benchmark\((.*)\,(.*)\))|(waitfor delay '0:0:))",
            "description" => "Detects blind sqli tests using sleep() or benchmark(). time based sql injection",
            "tag" => "sqli",
            "impact" => "4"
        ),
        array(
            "id" => "76",
            "rule" => "((union)*(.*)select )((@@version)|(\* FROM v\$version)|(version\(\)))",
            "description" => "Detected input Querying the database type and version",
            "tag" => "sqli",
            "impact" => "3"
        ),

        array(
            'id' => '1',
            'rule' => '(?:"[^"]*[^-]?>)|(?:[^\\w\\s]\\s*\\/>)|(?:>")',
            'description' => 'finds html breaking injections including whitespace attacks',
            'tag' => 'xss',
            'impact' => '4',
        ),

        array(
            'id' => '2',
            'rule' => '(?:"+.*[<=]\\s*"[^"]+")|(?:"\\s*\\w+\\s*=)|(?:>\\w=\\/)|(?:#.+\\)["\\s]*>)|(?:"\\s*(?:src|style|on\\w+)\\s*=\\s*")|(?:[^"]?"[,;\\s]+\\w*[\\[\\(])',
            'description' => 'finds attribute breaking injections including whitespace attacks',
            'tag' => 'xss',
            'impact' => '4'
        ),
        array(
            'id' => '3',
            'rule' => '(?:^>[\\w\\s]*<\\/?\\w{2,}>)',
            'description' => 'finds unquoted attribute breaking injections',


            'tag' => 'xss',
            'impact' => '2'
        ),
        array(
            'id' => '4',
            'rule' => '(?:[+\\/]\\s*name[\\W\\d]*[)+])|(?:;\\W*url\\s*=)|(?:[^\\w\\s\\/?:>]\\s*(?:location|referrer|name)\\s*[^\\/\\w\\s-])',
            'description' => 'Detects url-, name-, JSON, and referrer-contained payload attacks',

            'tag' => 'xss',
            'impact' => '5'
        ),
        array(
            'id' => '5',
            'rule' => '(?:\\W\\s*hash\\s*[^\\w\\s-])|(?:\\w+=\\W*[^,]*,[^\\s(]\\s*\\()|(?:\\?"[^\\s"]":)|(?:(?<!\\/)__[a-z]+__)|(?:(?:^|[\\s)\\]\\}])(?:s|g)etter\\s*=)',
            'description' => 'Detects hash-contained xss payload attacks, setter usage and property overloading',

            'tag' => 'xss',
            'impact' => '5',
        ),

        array(
            'id' => '6',
            'rule' => '(?:with\\s*\\(\\s*.+\\s*\\)\\s*\\w+\\s*\\()|(?:(?:do|while|for)\\s*\\([^)]*\\)\\s*\\{)|(?:\\/[\\w\\s]*\\[\\W*\\w)',
            'description' => 'Detects self contained xss via with(), common loops and regex to string conversion',

            'tag' => 'xss',
            'impact' => '5'
        ),

        array(
            'id' => '7',
            'rule' => '(?:[=(].+\\?.+:)|(?:with\\([^)]*\\)\\))|(?:\\.\\s*source\\W)',
            'description' => 'Detects JavaScript with(), ternary operators and XML predicate attacks',

            'tag' => 'xss',
            'impact' => '5'
        ),
        array(
            'id' => '9',
            'rule' => '(?:\\\\u00[a-f0-9]{2})|(?:\\\\x0*[a-f0-9]{2})|(?:\\\\\\d{2,3})',
            'description' => 'Detects the IE octal, hex and unicode entities',

            'tag' => 'xss',
            'impact' => '2'
        ),
        array(
            'id' => '13',
            'rule' => '(?:%u(?:ff|00|e\\d)\\w\\w)|(?:(?:%(?:e\\w|c[^3\\W]|))(?:%\\w\\w)(?:%\\w\\w)?)',
            'description' => 'Detects halfwidth/fullwidth encoded unicode HTML breaking attempts',

            'tag' => 'xss',
            'impact' => '3'
        ),

        array(
            'id' => '14',
            'rule' => '(?:#@~\\^\\w+)|(?:\\w+script:|@import[^\\w]|;base64|base64,)|(?:\\w\\s*\\([\\w\\s]+,[\\w\\s]+,[\\w\\s]+,[\\w\\s]+,[\\w\\s]+,[\\w\\s]+\\))',
            'description' => 'Detects possible includes, VBSCript/JScript encodeed and packed functions',

            'tag' => 'xss',
            'impact' => '5'
        ),
        array(
            'id' => '15',
            'rule' => '([^*:\\s\\w,.\\/?+-]\\s*)?(?<![a-z]\\s)(?<![a-z\\/_@\\-\\|])(\\s*return\\s*)?(?:create(?:element|attribute|textnode)|[a-z]+events?|setattribute|getelement\\w+|appendchild|createrange|createcontextualfragment|removenode|parentnode|decodeuricomponent|\\wettimeout|(?:ms)?setimmediate|option|useragent)(?(1)[^\\w%"]|(?:\\s*[^@\\s\\w%",.+\\-]))',
            'description' => 'Detects JavaScript DOM/miscellaneous properties and methods',
            'tag' => 'xss',
            'impact' => '6'
        ),
        // array(
        //     'id' => '16',
        //     'rule' => '([^*\\s\\w,.\\/?+-]\\s*)?(?<![a-mo-z]\\s)(?<![a-z\\/_@])(\\s*return\\s*)?(?:alert|inputbox|showmod(?:al|eless)dialog|showhelp|infinity|isnan|isnull|iterator|msgbox|executeglobal|expression|prompt|write(?:ln)?|confirm|dialog|urn|(?:un)?eval|exec|execscript|tostring|status|execute|window|unescape|navigate|jquery|getscript|extend|prototype)(?(1)[^\\w%"]|(?:\\s*[^@\\s\\w%",.:\\/+\\-]))',
        //     'description' => 'Detects possible includes and typical script methods',
        //     'tag' => 'xss',
        //     'impact' => '5',
        // ),

        array(
            'id' => '17',
            'rule' => '([^*:\\s\\w,.\\/?+-]\\s*)?(?<![a-z]\\s)(?<![a-z\\/_@])(\\s*return\\s*)?(?:hash|name|href|navigateandfind|source|pathname|close|constructor|port|protocol|assign|replace|back|forward|document|ownerdocument|window|top|this|self|parent|frames|_?content|date|cookie|innerhtml|innertext|csstext+?|outerhtml|print|moveby|resizeto|createstylesheet|stylesheets)(?(1)[^\\w%"]|(?:\\s*[^@\\/\\s\\w%.+\\-]))',
            'description' => 'Detects JavaScript object properties and methods',
            'tag' => 'xss',
            'impact' => '4',
        ),

        array(
            'id' => '18',
            'rule' => '([^*:\\s\\w,.\\/?+-]\\s*)?(?<![a-z]\\s)(?<![a-z\\/_@\\-\\|])(\\s*return\\s*)?(?:join|pop|push|reverse|reduce|concat|map|shift|sp?lice|sort|unshift)(?(1)[^\\w%"]|(?:\\s*[^@\\s\\w%,.+\\-]))',
            'description' => 'Detects JavaScript array properties and methods',
            'tag' => 'xss',
            'impact' => '4',
        ),

        array(
            'id' => '19',
            'rule' => '([^*:\\s\\w,.\\/?+-]\\s*)?(?<![a-z]\\s)(?<![a-z\\/_@\\-\\|])(\\s*return\\s*)?(?:set|atob|btoa|charat|charcodeat|charset|concat|crypto|frames|fromcharcode|indexof|lastindexof|match|navigator|toolbar|menubar|replace|regexp|slice|split|substr|substring|escape|\\w+codeuri\\w*)(?(1)[^\\w%"]|(?:\\s*[^@\\s\\w%,.+\\-]))',
            'description' => 'Detects JavaScript string properties and methods',
            'tag' => 'xss',
            'impact' => '4',
        ),

        array(
            'id' => '20',
            'rule' => '(?:\\)\\s*\\[)|([^*":\\s\\w,.\\/?+-]\\s*)?(?<![a-z]\\s)(?<![a-z_@\\|])(\\s*return\\s*)?(?:globalstorage|sessionstorage|postmessage|callee|constructor|content|domain|prototype|try|catch|top|call|apply|url|function|object|array|string|math|if|for\\s*(?:each)?|elseif|case|switch|regex|boolean|location|(?:ms)?setimmediate|settimeout|setinterval|void|setexpression|namespace|while)(?(1)[^\\w%"]|(?:\\s*[^@\\s\\w%".+\\-\\/]))',
            'description' => 'Detects JavaScript language constructs',
            'tag' => 'xss',
            'impact' => '4'
        // ),
        // array(
        //     'id' => '21',
        //     'rule' => '(?:,\\s*(?:alert|showmodaldialog|eval)\\s*,)|(?::\\s*eval\\s*[^\\s])|([^:\\s\\w,.\\/?+-]\\s*)?(?<![a-z\\/_@])(\\s*return\\s*)?(?:(?:document\\s*\\.)?(?:.+\\/)?(?:alert|eval|msgbox|showmod(?:al|eless)dialog|showhelp|prompt|write(?:ln)?|confirm|dialog|open))\\s*(?:[^.a-z\\s\\-]|(?:\\s*[^\\s\\w,.@\\/+-]))|(?:java[\\s\\/]*\\.[\\s\\/]*lang)|(?:\\w\\s*=\\s*new\\s+\\w+)|(?:&\\s*\\w+\\s*\\)[^,])|(?:\\+[\\W\\d]*new\\s+\\w+[\\W\\d]*\\+)|(?:document\\.\\w)',
        //     'description' => 'Detects very basic XSS probings',
        //     'tag' => 'xss',
        //     'impact' => '3',
         ),
        array(
            'id' => '22',
            'rule' => '(?:=\\s*(?:top|this|window|content|self|frames|_content))|(?:\\/\\s*[gimx]*\\s*[)}])|(?:[^\\s]\\s*=\\s*script)|(?:\\.\\s*constructor)|(?:default\\s+xml\\s+namespace\\s*=)|(?:\\/\\s*\\+[^+]+\\s*\\+\\s*\\/)',
            'description' => 'Detects advanced XSS probings via Script(), RexExp, constructors and XML namespaces',
            'tag' => 'xss',
            'impact' => '5'
        ),
        array(
            'id' => '23',
            'rule' => '(?:\\.\\s*\\w+\\W*=)|(?:\\W\\s*(?:location|document)\\s*\\W[^({[;]+[({[;])|(?:\\(\\w+\\?[:\\w]+\\))|(?:\\w{2,}\\s*=\\s*\\d+[^&\\w]\\w+)|(?:\\]\\s*\\(\\s*\\w+)',
            'description' => 'Detects JavaScript location/document property access and window access obfuscation',
            'tag' => 'xss',
            'impact' => '5'
        ),
        array(
            'id' => '24',
            'rule' => '(?:[".]script\\s*\\()|(?:\\$\\$?\\s*\\(\\s*[\\w"])|(?:\\/[\\w\\s]+\\/\\.)|(?:=\\s*\\/\\w+\\/\\s*\\.)|(?:(?:this|window|top|parent|frames|self|content)\\[\\s*[(,"]*\\s*[\\w\\$])|(?:,\\s*new\\s+\\w+\\s*[,;)])',
            'description' => 'Detects basic obfuscated JavaScript script injections',
            'tag' => 'xss',
            'impact' => '5'
        ),
        array(
            'id' => '25',
            'rule' => '(?:=\\s*[$\\w]\\s*[\\(\\[])|(?:\\(\\s*(?:this|top|window|self|parent|_?content)\\s*\\))|(?:src\\s*=s*(?:\\w+:|\\/\\/))|(?:\\w+\\[("\\w+"|\\w+\\|\\|))|(?:[\\d\\W]\\|\\|[\\d\\W]|\\W=\\w+,)|(?:\\/\\s*\\+\\s*[a-z"])|(?:=\\s*\\$[^([]*\\()|(?:=\\s*\\(\\s*")',
            'description' => 'Detects obfuscated JavaScript script injections',
            'tag' => 'xss',
            'impact' => '5'
        ),
        array(
            'id' => '26',
            'rule' => '(?:[^:\\s\\w]+\\s*[^\\w\\/](href|protocol|host|hostname|pathname|hash|port|cookie)[^\\w])',
            'description' => 'Detects JavaScript cookie stealing and redirection attempts',
            'tag' => 'xss',
            'impact' => '4'
        ),
        array(
            'id' => '27',
            'rule' => '(?:(?:vbs|vbscript|data):.*[,+])|(?:\\w+\\s*=\\W*(?!https?)\\w+:)|(jar:\\w+:)|(=\\s*"?\\s*vbs(?:ript)?:)|(language\\s*=\\s?"?\\s*vbs(?:ript)?)|on\\w+\\s*=\\*\\w+\\-"?',
            'description' => 'Detects data: URL injections, VBS injections and common URI schemes',
            'tag' => 'xss',
            'impact' => '5'
        ),
        array(
            'id' => '28',
            'rule' => '(?:firefoxurl:\\w+\\|)|(?:(?:file|res|telnet|nntp|news|mailto|chrome)\\s*:\\s*[%&#xu\\/]+)|(wyciwyg|firefoxurl\\s*:\\s*\\/\\s*\\/)',
            'description' => 'Detects IE firefoxurl injections, cache poisoning attempts and local file inclusion/execution',
            'tag' => 'xss',
            'impact' => '5'
        ),

        array(
            'id' => '29',
            'rule' => '(?:binding\\s?=|moz-binding|behavior\\s?=)|(?:[\\s\\/]style\\s*=\\s*[-\\\\])',
            'description' => 'Detects bindings and behavior injections',
            'tag' => 'xss',
            'impact' => '4'
        ),
        array(
            'id' => '30',
            'rule' => '(?:=\\s*\\w+\\s*\\+\\s*")|(?:\\+=\\s*\\(\\s")|(?:!+\\s*[\\d.,]+\\w?\\d*\\s*\\?)|(?:=\\s*\\[s*\\])|(?:"\\s*\\+\\s*")|(?:[^\\s]\\[\\s*\\d+\\s*\\]\\s*[;+])|(?:"\\s*[&|]+\\s*")|(?:\\/\\s*\\?\\s*")|(?:\\/\\s*\\)\\s*\\[)|(?:\\d\\?.+:\\d)|(?:]\\s*\\[\\W*\\w)|(?:[^\\s]\\s*=\\s*\\/)',
            'description' => 'Detects common XSS concatenation patterns 1/2',
            'tag' => 'xss',
            'impact' => '4',
        ),
        array(
            'id' => '31',
            'rule' => '(?:=\\s*\\d*\\.\\d*\\?\\d*\\.\\d*)|(?:[|&]{2,}\\s*")|(?:!\\d+\\.\\d*\\?")|(?:\\/:[\\w.]+,)|(?:=[\\d\\W\\s]*\\[[^]]+\\])|(?:\\?\\w+:\\w+)',
            'description' => 'Detects common XSS concatenation patterns 2/2',
            'tag' => 'xss',
            'impact' => '4'
        ),
        array(
            'id' => '32',
            'rule' => '(?:[^\\w\\s=]on(?!g\\&gt;)\\w+[^=_+-]*=[^$]+(?:\\W|\\&gt;)?)',
            'description' => 'Detects possible event handlers',
            'tag' => 'xss',
            'impact' => '4'
        ),
        array(
            'id' => '33',
            'rule' => '(?:\\<\\w*:?\\s(?:[^\\>]*)t(?!rong))|(?:\\<scri)|(<\\w+:\\w+)',
            'description' => 'Detects obfuscated script tags and XML wrapped HTML',
            'tag' => 'xss',
            'impact' => '4'
        ),
        array(
            'id' => '34',
            'rule' => '(?:\\<\\/\\w+\\s\\w+)|(?:@(?:cc_on|set)[\\s@,"=])',
            'description' => 'Detects attributes in closing tags and conditional compilation tokens',
            'tag' => 'xss',
            'impact' => '4'
        ),
        array(
            'id' => '37',
            'rule' => '(?:\\<base\\s+)|(?:<!(?:element|entity|\\[CDATA))',
            'description' => 'Detects base href injections and XML entity injections',
            'tag' => 'xss',
            'impact' => '5'
        ),
        array(
            'id' => '38',
            'rule' => '(?:\\<[\\/]?(?:[i]?frame|applet|isindex|marquee|keygen|script|audio|video|input|button|textarea|style|base|body|meta|link|object|embed|param|plaintext|xm\\w+|image|im(?:g|port)))',
            'description' => 'Detects possibly malicious html elements including some attributes',
            'tag' => 'xss',
            'impact' => '4'
        ),

        array(
            'id' => '39',
            'rule' => '(?:\\\\x[01fe][\\db-ce-f])|(?:%[01fe][\\db-ce-f])|(?:&#[01fe][\\db-ce-f])|(?:\\\\[01fe][\\db-ce-f])|(?:&#x[01fe][\\db-ce-f])',
            'description' => 'Detects nullbytes and other dangerous characters',
            'tag' => 'xss',
            'impact' => '5'
        ),
        array(
            'id' => '67',
            'rule' => '(?:\\({2,}\\+{2,}:{2,})|(?:\\({2,}\\+{2,}:+)|(?:\\({3,}\\++:{2,})|(?:\\$\\[!!!\\])',
            'description' => 'Detects unknown attack vectors based on PHPIDS Centrifuge detection',
            'tag' => 'xss',
            'impact' => '7'
        ),
        array(
            'id' => '68',
            'rule' => '(?:[\\s\\/"]+[-\\w\\/\\\\\\*]+\\s*=.+(?:\\/\\s*>))',
            'description' => 'Finds attribute breaking injections including obfuscated attributes',
            'tag' => 'xss',
            'impact' => '4'
        ),

        array(
            'id' => '69',
            'rule' => '(?:(?:msgbox|eval)\\s*\\+|(?:language\\s*=\\*vbscript))',
            'description' => 'Finds basic VBScript injection attempts',
            'tag' => 'xss',
            'impact' => '4'
        ),

        array(
            'id' => '71',
            'rule' => '(?:[\\s\\d\\/"]+(?:on\\w+|style|poster|background)=[$"\\w])|(?:-type\\s*:\\s*multipart)',
            'description' => 'finds malicious attribute injection attempts and MHTML attacks',
            'tag' => 'xss',
            'impact' => '6'
        )
    );
}
