<?php
    class curl {
        /**
         * Do a get request
         * @param string  $request The URL you want to open
         * @param array   $options Options you want to add to cURL
         * @param array   $headers Headers you want to add
         * @return string          Page contents
        **/
        public static function get($request='', $options=array(), $headers=array()) {
            //Initializing...
            $ch = curl_init();
            //Set the URL
            curl_setopt($ch, CURLOPT_URL, $request);
            //Some defaults
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_TIMEOUT, '3');
            //Extra options
            foreach($options as $opt => $val)
                curl_setopt($cf, $opt, $val);
            //Headers
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            //Set the content as a variable
            $content = curl_exec($ch);
            //Close the connection
            curl_close($ch);
            //Return it
            return $content;
        }
        /**
         * Do a POST request
         * @param string  $request The URL you want to open
         * @param array   $content POST data
         * @param array   $options Options you want to add to cURL
         * @param array   $headers Headers you want to add
         * @return string          Page contents
        **/
        public static function post($request='', $content=array(), $options=array(), $headers=array()) {
            //Set the post fields
            $fields_string = '';
            foreach($content as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
            rtrim($fields_string, '&');
            
            //Initializing...
            $ch = curl_init();
            
            //Set the URL
            curl_setopt($ch, CURLOPT_URL, $request);
            //Default options
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_TIMEOUT, '3');
            //Extra options
            foreach($options as $opt => $val)
                curl_setopt($ch, $opt, $val);
            //Add POST content
            curl_setopt($ch,CURLOPT_POST, count($content));
            curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
            //Add headers
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            //Run!
            $content = curl_exec($ch);
            //Close the connection
            curl_close($ch);
            //Return the page.
            return $content;
        }
        /**
         * Do a PUT request
         * @param string  $request The URL you want to open
         * @param array   $content PUT data
         * @param array   $options Options you want to add to cURL
         * @param array   $headers Headers you want to add
         * @return string          Page contents
         **/
        public static function put($request='', $content='', $options=array(), $headers=array()) {
            //Init
            $ch = curl_init();
            
            // Set the URL
            curl_setopt($ch, CURLOPT_URL, $request);
            //Add the headers
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            //Default options
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
            curl_setopt($ch, CURLOPT_TIMEOUT, '3');
            //Extra options
            foreach($options as $opt => $val)
                curl_setopt($ch, $opt, $val);
            //Add content
            curl_setopt($ch, CURLOPT_POSTFIELDS, $content);
            //Run!
            $content = curl_exec($ch);
            //Close the connection
            curl_close($ch);
            //Return the page.
            return $content;
        }
        /**
         * Do a DELETE request
         * @param string  $request The URL you want to open
         * @param array   $content DELETE data
         * @param array   $options Options you want to add to cURL
         * @param array   $headers Headers you want to add
         * @return string          Page contents
         **/
        public static function delete($request='', $content=array(), $options=array(), $headers=array()) {
            //Set the content
            $fields_string = '';
            foreach($content as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
            rtrim($fields_string, '&');
            //Initializing....
            $ch = curl_init();
            
            //Set the URL
            curl_setopt($ch, CURLOPT_URL, $request);
            //Default options
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_TIMEOUT, '3');
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
            //Extra options
            foreach($options as $opt => $val)
                curl_setopt($ch, $opt, $val);
            //Set the data
            curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
            //Extra headers
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            //Run!
            $content = trim(curl_exec($ch));
            //Close the connection
            curl_close($ch);
            //Return the page
            return $content;
        }
    }