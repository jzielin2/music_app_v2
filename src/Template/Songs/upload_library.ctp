	<form id="upload" action="/Songs/uploadLibrary" method="POST" enctype="multipart/form-data">

	<input type="hidden" id="MAX_FILE_SIZE" name="MAX_FILE_SIZE" value="30000000000" />

	<div>
		<label for="fileselect">Files to upload:</label>
		<input type="file" name="upload" />
	</div>

	<div id="submitbutton">
		<button type="submit">Upload Files</button>
	</div>

	</fieldset>

	</form>