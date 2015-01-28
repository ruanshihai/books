<?php
    /*
     * 防挂马、防跨站攻击、防sql注入函数
     * $data 传入的参数，要是个变量或者数组；$ignore_magic_quotes变量的魔术引用
     */
    function in($data, $ignore_magic_quotes=false) {
        if(is_string($data)) {
            //$data=trim(htmlspecialchars($data)); //防止被挂马，跨站攻击
            if(($ignore_magic_quotes==true) || (!get_magic_quotes_gpc()))
                $data = addslashes($data); //防止sql注入
            return  $data;
        } else if(is_array($data)) { //如果是数组采用递归过滤
            foreach($data as $key=>$value) {
                $data[$key]=in($value);
            }
            return $data;
        } else {
            return $data;
        } 
    }
?>