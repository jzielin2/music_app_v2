<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * Songs Controller
 *
 * @property \App\Model\Table\SongsTable $Songs
 */
class SongsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $songs = $this->paginate($this->Songs);

        $this->set(compact('songs'));
        $this->set('_serialize', ['songs']);
    }

    /**
     * View method
     *
     * @param string|null $id Song id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $song = $this->Songs->get($id, [
            'contain' => []
        ]);

        $this->set('song', $song);
        $this->set('_serialize', ['song']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $song = $this->Songs->newEntity();
        if ($this->request->is('post')) {
            $song = $this->Songs->patchEntity($song, $this->request->data);
            if ($this->Songs->save($song)) {
                $this->Flash->success(__('The song has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The song could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('song'));
        $this->set('_serialize', ['song']);
    }

    public function uploadLibrary()
    {
        //If there is data being posted, and it's a file, then continue
        if (!empty($this->request->data)) {
            if (!empty($this->request->data['upload']['name'])) {
                
                //Store the file metadata
                $file = $this->request->data['upload'];

                //Check that the file is an XML - NEED TO CHECK MIME TYPE AS WELL
                $ext = substr(strtolower(strrchr($file['name'], '.')), 1);
                if ($ext == 'xml') {

                    // try {
                    
                    //     $libraryXML = fopen($file['tmp_name'], "r");
                    //     $this->insertRawiTunesData(1, 2);


                    // } catch (Exception $e) {
                    //     $this->Flash->success('Error in uploading file');
                    // }

                    // $size = fstat($libraryXML)[7];
                    // echo "<br/>Size is: " . $this->checkFileSize($size);

                    $this->processLibrary($file['tmp_name']);

                }
                else{
                   $this->Flash->success('Failure in 1');
                }
            }
            else{
                $this->Flash->success('Failure in 2');
            }
        }
        else{
            $this->Flash->success('Failure in 3');
        }
    }

    /**
     * Edit method
     *
     * @param string|null $id Song id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $song = $this->Songs->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $song = $this->Songs->patchEntity($song, $this->request->data);
            if ($this->Songs->save($song)) {
                $this->Flash->success(__('The song has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The song could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('song'));
        $this->set('_serialize', ['song']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Song id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $song = $this->Songs->get($id);
        if ($this->Songs->delete($song)) {
            $this->Flash->success(__('The song has been deleted.'));
        } else {
            $this->Flash->error(__('The song could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }

    private function checkFileSize($size){
        if($size < 1024)
            return "File size: " . $size . " B."  . "<br/>";
        else if($size/1024 < 1024)
            return "File size: " . round($size/1024,2) . " KB." . "<br/>";
        else if($sizeMB = $size/1024/1024 < 1024)
            return "File size: " . round($size/1024/1024,2) . " MB." . "<br/>";
        else if($sizeGB = $size/1024/1024/1024 < 1024)
            return "File size: " . round($size/1024/1024/1024,2) . " GB." . "<br/>";
        else
            return "File too big";
    }

    private function processLibrary($fileName){
        $libraryXML = fopen($fileName, "r");

        $dictionaryLevel = 0;
        $complete = false;
        $songCounter = 1;
        $lineCounter = 1;

        $construct = array(
            "Album"=>array("&lt;string&gt" , "&lt;/string&gt"),
            "Artist"=>array("&lt;string&gt" , "&lt;/string&gt"),
            "Bit Rate"=>array("&lt;integer&gt" , "&lt;/integer&gt"),
            "Composer"=>array("&lt;string&gt" , "&lt;/string&gt"),
            "Genre"=>array("&lt;string&gt" , "&lt;/string&gt"),
            "Kind"=>array("&lt;string&gt" , "&lt;/string&gt"),
            "Name"=>array("&lt;string&gt" , "&lt;/string&gt"),
            "Play Count"=>array("&lt;integer&gt" , "&lt;/integer&gt"),
            "Play Date UTC"=>array("&lt;date&gt" , "&lt;/date&gt"),
            "Rating"=>array("&lt;integer&gt" , "&lt;/integer&gt"),
            "Sample Rate"=>array("&lt;integer&gt" , "&lt;/integer&gt"),
            "Size"=>array("&lt;integer&gt" , "&lt;/integer&gt"),
            "Skip Count"=>array("&lt;integer&gt" , "&lt;/integer&gt"),
            "Total Time"=>array("&lt;integer&gt" , "&lt;/integer&gt"),
            "Track ID"=>array("&lt;integer&gt" , "&lt;/integer&gt"),
            "Year"=>array("&lt;integer&gt" , "&lt;/integer&gt")
        );

        $timeStart = microtime(true);

        //Loop for the base
        while ($dictionaryLevel == 0 && ! feof($libraryXML) && ! $complete){
            if (strpos($line = htmlentities(fgets($libraryXML)), "/dict&gt;") == true){
                $dictionaryLevel--;
            }
            elseif(strpos($line, "dict&gt")){
                $dictionaryLevel++;
            }

            //echo $line . " - this is line number " . $lineCounter++ . " - it is in loop number " . $dictionaryLevel . "<br/>";

            while($dictionaryLevel == 1 && ! $complete){
                if (strpos($line = htmlentities(fgets($libraryXML)), "/dict&gt;") == true){
                    $dictionaryLevel--;
                }
                elseif(strpos($line, "dict&gt")){
                    $dictionaryLevel++;
                }


                //echo $line . " - this is line number " . $lineCounter++ . " - it is in loop number " . $dictionaryLevel . "THIS ONE<br/>";


                //now we're looking at each song
                while($dictionaryLevel == 2 && ! $complete){
                    if (strpos($line = htmlentities(fgets($libraryXML)), "/dict&gt;") == true){
                        $dictionaryLevel--;
                        $complete = true;

                        $totalTime = microtime(true) - $timeStart;

                        echo "Total processing time: " . round($totalTime, 2) . " seconds.";
                        break;
                    }
                    elseif(strpos($line, "dict&gt")){
                        $dictionaryLevel++;
                    
                        //echo "<br/>";
                        //echo "This is a song<br/>";
                        //echo "=====================================================================<br/>";
                    }

                    //echo $line . " - this is line number " . $lineCounter++ . " - it is in loop number " . $dictionaryLevel . "<br/>";

                    $songsTable = TableRegistry::get('Songs');
                    $song = $songsTable->newEntity();
                    
                    while($dictionaryLevel == 3){
                        if (strpos($line = htmlentities(fgets($libraryXML)), "/dict&gt;") == true){
                            $dictionaryLevel--;

                            //echo "Album is: " . $song->Album;
                            $song->User_Id = $this->Auth->user('id');

                            if ($songsTable->save($song)) {
                                $this->log("Saving data for '" . $song->Name . "' by " . $song->Artist, 'debug');
                            }

                        }
                        elseif(strpos($line, "dict&gt")){
                            $dictionaryLevel++;
                        }

                        $start = strpos($line, "&lt;key&gt;") + 11;
                        $end = strpos($line, "&lt;/key&gt;");

                        $key = substr($line, $start, $end-$start);

                        if(gettype($key) != "string" && gettype($key) != "integer"){
                            $key = "ALLDONE!";
                        }

                        if (array_key_exists($key, $construct)){
                            $valueEnd = strpos($line, $construct[$key][1]);
                            $valueStart = strpos($line, $construct[$key][0]) + strlen($construct[$key][0]) +1;

                            $value = substr($line, $valueStart, $valueEnd-$valueStart);

                            //Date is formatted as YYYY-MM-DDTHH:MM:SSZ.  MySQL doesn't accept the extra T and Z.  We remove
                            //those here so it can be inserted correctly
                            if($key == "Play Date UTC"){
                                    $value = str_replace("Z", "", str_replace("T", " ", $value));
                            }

                            $key = str_replace(" ", "", $key);
                            $song->$key = $value;

                            //echo $line . " - this is line number " . $lineCounter++ . " - it is in loop number " . $dictionaryLevel . " - the key value is " . $start . "|" . $end . "|" . $key . "|". $valueStart . "|" . $valueEnd . "|" . $value . "<br/>";
                        }
                    }
                }       
            }
        }

        fclose($libraryXML);
    }

    private function insertRawiTunesData($columns, $values){
        
        //Strings / array we'll used to dynamically build the prepared statement
        // $fields = "";
        // $DBOvalues = "";
        // $parameters = array();

        echo "Saving Now";
        $param = "Album";

        $songsTable = TableRegistry::get('Songs');
        $song = $songsTable->newEntity();

        print_r($songsTable);

        echo "<br/><br/>";

        print_r($song);

        $song->User_Id = '1';
        $song->Artist = "test";

        $song->$param = "myAlbum";

        echo $song->$param;

        // if ($songsTable->save($song)) {
        //     // The $article entity contains the id now
        //     $id = $song->id;
        // }

        // //Build the query strings that will make the prepared statement later on.  Has to accept an 
        // //arbitrary number of values since we may get an arbitrary number of them from iTunes. 
        // for ($i=0; $i<count($columns); $i++){
        //     $fields = $fields . $columns[$i] . ",";
        //     $DBOvalues = $DBOvalues . ':' . $columns[$i] . ",";
        //     $parameters[":" . $columns[$i]] = $values[$i];
        // }

        // //Get rid of the trailing comma
        // $fields = substr($fields, 0, strlen($fields)-1);
        // $DBOvalues = substr($DBOvalues, 0, strlen($DBOvalues)-1);

        // //Execute the prepared statement using the strings we built above
        // $insertStatement = $this->connection->prepare("INSERT INTO songs (" . $fields . ") VALUES ( " . $DBOvalues . " )");
        // $insertStatement->execute($parameters);

        
    }
}
