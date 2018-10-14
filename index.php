<?php
/*

 * Author: Huzaib Shafi
 * Author Website: http://www.shafihuzaib.com

 * The MIT License
 *
 * Copyright 2014 Huzaib Shafi (http://www.shafihuzaib.com).
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

$post = $_POST;
if(!empty($post)) {
    if(isset($post['remove'])) {
        foreach($post['remove'] as $toBeRemoved => $buttonValue) {
            unlink('xml/' . $toBeRemoved);
        }
    }
}
$filename = uniqid("h");
include_once 'header.php';
$files = array_filter(scandir('xml'), function($file) {
    $extension = ".xml";
    $length = strlen($extension);
    return (substr($file, -$length) === $extension);
});
?>
<form method="POST" action="prepat.php?file=<?php echo $filename; ?>">
    <input size="80" placeholder="Enter url" type="text" name = "url">
    <input size="10" placeholder="Encoding Type" type="text" name = "encoding">
    <input type="submit">
</form>
<?php
if(count($files) > 0) {
?>
<form method="POST" action=".">
    <ul>
        <?php
            foreach( $files as $file ) {
            ?>
                <li>
                    <a href="xml/<?php echo $file; ?>"><?php echo $file; ?></a>
                    <input type="submit" name="remove[<?php echo $file; ?>]" value="DEL">
                </li>
            <?php
            }
        ?>
    </ul>
</form>
<?php
}
include_once 'footer.php';
?>
