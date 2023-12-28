<?php



namespace Solenoid\HTML;



class Document
{
    private $dom   = null;
    private $xpath = null;



    # Returns [self] | Throws [Exception]
    public function __construct (string $content)
    {
        // (Creating a DOMDocument)
        $this->dom = new \DOMDocument();

        if ( $this->dom->loadHTML( $content ) === false )
        {// (Unable to load the HTML)
            // (Setting the value)
            $message = "Unable to load the HTML";

            // Throwing an exception
            throw new \Exception($message);

            // Returning the value
            return;
        }



        // (Creating a DOMXPath)
        $this->xpath = new \DOMXPath( $this->dom );
    }

    # Returns [Document]
    public static function read (string $content)
    {
        // Returning the value
        return new Document( $content );
    }



    # Returns [\DomNodeList|false] | Throws [Exception]
    public function execute (string $query)
    {
        // (Executing the query)
        $result = $this->xpath->query( $query );

        if ( $result === false )
        {// (Unable to execute the query)
            // (Setting the value)
            $message = "Unable to execute the query";

            // Throwing an exception
            throw new \Exception($message);

            // Returning the value
            return false;
        }



        // Returning the value
        return $result;
    }



    # Returns [string|false] | Throws [Exception]
    public function to_string ()
    {
        // (Getting the value)
        $content = $this->dom->saveHTML();

        if ( $content === false )
        {// (Unable to save the content)
            // (Setting the value)
            $message = "Unable to save the content";

            // Throwing an exception
            throw new \Exception($message);

            // Returning the value
            return false;
        }



        // Returning the value
        return $content;
    }



    # Returns [string]
    public function __toString()
    {
        // Returning the value
        return $this->to_string();
    }
}



?>