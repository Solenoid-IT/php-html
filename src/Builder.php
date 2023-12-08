<?php



namespace Solenoid\HTML;



class Builder
{
    private string $html_content;



    # Returns [void]
    public function __construct (string $html_content)
    {
        // (Getting the value)
        $this->html_content = $html_content;
    }

    # Returns [Builder]
    public static function create (string $html_content)
    {
        // Returning the value
        return new Builder( $html_content );
    }



    # Returns [self]
    public function replace (array $kv_data)
    {
        foreach ($kv_data as $k => $v)
        {// Processing each entry
            // (Getting the value)
            $this->html_content = str_replace( $k, $v, $this->html_content );
        }



        // Returning the value
        return $this;
    }



    # Returns [self]
    public function prepend (string $target, string $content)
    {
        // (Getting the value)
        #$this->html_content = str_replace("<$target>", "<$target>$content", $this->html_content);
        $this->html_content = preg_replace( '/<'.$target.'([^>]*)>/', "<$target$1>$content", $this->html_content );



        // Returning the value
        return $this;
    }

    # Returns [self]
    public function append (string $target, string $content)
    {
        // (Getting the value)
        $this->html_content = str_replace( "</$target>", "$content</$target>", $this->html_content );



        // Returning the value
        return $this;
    }



    # Returns [self]
    public function append_var (string $name, $content)
    {
        // (Getting the values)
        $k = $name;
        $v = json_encode( $content );



        // Returning the value
        return $this->append( 'head', "<script>$k = $v;</script>" );
    }



    # Returns [string]
    public function fetch_content ()
    {
        // Returning the value
        return $this->html_content;
    }



    # Returns [string]
    public function __toString ()
    {
        // Returning the value
        return $this->fetch_content();
    }
}



?>