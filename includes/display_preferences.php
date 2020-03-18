<div id="optionContainer" class="optionDiv" style="display: block;" align="center">
    <div id="displayPreferences">
        <lable><b style="font-size: 20px;">Image Display Preference: </b></lable>
        <input type="radio" name="showImage" value="Show Images" id="showImg" checked onclick="toggleImage()" /><label for="showImg">Show Images</label>
        <input type="radio" style="margin-left:15px;" name="showImage" id="maskImg" value="Mask Images" onclick="toggleImage()" /><label for="maskImg">Mask Images</label>
        <input type="radio" style="margin-left:15px;" name="showImage" id="numbersOnly" value="Show Numbers Only" onclick="toggleImage()" /><label for="numbersOnly">Show Numbers Only</label>
        <input type="radio" style="margin-left:15px;" name="showImage" id="lettersOnly" value="Mask Letters Only" onclick="toggleImage()" /><label for="lettersOnly">Show Letters Only</label>
    </div>

    <div id="answerPreferences">
        <lable><b style="font-size: 20px;">Answer Display Preference: </b></lable>
        <input type="radio" name="showAnswers" id="noAnswers" value="Do Not Show Answers" checked onclick="toggleAnswer()" /><label for="noAnswers">Do Not Show Answers</label>
        <input type="radio" style="margin-left:15px;" name="showAnswers" id="belowImg" value="Show Answers Below the Image" onclick="toggleAnswer()" /><label for="belowImg">Show Answers Below the Image</label>
        <input type="radio" style="margin-left:15px;" name="showAnswers" id="endPage" value="Show Answers At the end of the page" onclick="toggleAnswer()" /><label for="endPage">Show Answers At the end of the page</label>
    </div>

    <div id="imagePreferences">
        <lable><b style="font-size: 20px;">Image Size Preference: </b></lable>
        <input type="radio" name="imageSize" id="default" onclick="alterImageSize()" /><label for="default">Default</label>
        <input style="margin-left:5px;" size="2px" type="text" name="default" id="default"/>
        <input type="radio" style="margin-left:15px;" name="imageSize" id="heightDriven" onclick="alterImageSize()" /><label for="heightDriven">Height Driven</label>
        <input style="margin-left:5px;" size="2px" type="text" name="heightDriven" id="heightDriven"/>
        <input type="radio" style="margin-left:15px;" name="imageSize" id="widthDriven" onclick="alterImageSize()" /><label for="widthDriven">WidthDriven</label>
        <input style="margin-left:5px;" size="2px" type="text" name="widthDriven" id="widthDriven"/>
    </div>

    <div id="rowSizePreference">
        <lable><b style="font-size: 20px;">Number of images per row: </b></lable>
        <input type="radio" name="radioBtn" id="sizeOne" onclick="changeTableRow(id)" value="1" /><label for="sizeOne"> &nbsp 1 &nbsp &nbsp</label>
        <input type="radio" name="radioBtn" id="sizeTwo" onclick="changeTableRow(id)" value="2" /><label for="sizeTwo"> &nbsp 2 &nbsp &nbsp</label>
        <input type="radio" name="radioBtn" id="sizeThree" onclick="changeTableRow(id)" value="3" /><label for="sizeThree"> &nbsp 3 &nbsp &nbsp</label>
        <input type="radio" name="radioBtn" id="sizeFour" checked onclick="changeTableRow(id)" value="4" /><label for="sizeFour">&nbsp 4 &nbsp &nbsp</label>
        <input type="radio" name="radioBtn" id="sizeFive" onclick="changeTableRow(id)" value="5" /><label for="sizeFive"> &nbsp 5 &nbsp &nbsp</label>
        <input type="radio" name="radioBtn" id="sizeSix" onclick="changeTableRow(id)" value="6" /><label for="sizeSix">&nbsp 6 &nbsp &nbsp</label>
        <input type="radio" name="radioBtn" id="sizeSeven" onclick="changeTableRow(id)" value="7" /><label for="sizeSeven">&nbsp 7 &nbsp &nbsp</label>
        <input type="radio" name="radioBtn" id="sizeEight" onclick="changeTableRow(id)" value="8" /><label for="sizeEight">&nbsp 8 &nbsp &nbsp</label>
        <input type="radio" name="radioBtn" id="sizeNine" onclick="changeTableRow(id)" value="9" /><label for="sizeNine">&nbsp 9 &nbsp &nbsp</label>
        <input type="radio" name="radioBtn" id="sizeTen" onclick="changeTableRow(id)" value="10" /><label for="sizeTen">&nbsp 10 &nbsp &nbsp</label>
    </div>
</div>