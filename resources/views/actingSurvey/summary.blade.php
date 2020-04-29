<div class="summary">
    <ul id="summaryContent">
    </ul>
</div>
<script type="text/javascript">
    $(function () {

        var surveyObject = {!! json_encode($jsonObject, JSON_HEX_TAG);
                !!}

        var surveyJSONObject = JSON.parse(surveyObject);
        var visit = 0;
        $(".submit").mouseover(function () {
            if (visit < 1) {
                displaySummary(visit, surveyJSONObject);
                visit++;
            }
        });
        $(".submit").mouseenter(function () {
            if (visit < 1) {
                displaySummary(visit, surveyJSONObject);
                visit++;
            }
        });
        $(".submit").mousemove(function () {
            if (visit < 1) {
                displaySummary(visit, surveyJSONObject);
                visit++;
            }
        });
        $(".backward").click(function () {
            visit = 0;
            $("#summaryContent").empty();
        });
        /**
         * @param {type} visit
         * @param {type} surveyJSONObject
         * 
         * @returns {undefined}
         */
        function displaySummary(visit, surveyJSONObject) {
            if (visit < 1) {

                var questionsAnswersArray = [];
                var viewArray = [];
                var values = '';
                var index = 1;

                /**
                 * Collecting form responses
                 * 
                 * @param {type} i
                 * @param {type} field
                 * @returns {undefined}
                 */
                $.each($('#wrapped').serializeArray(), function (i, field) {

                    if (field.name.includes("questionId##")) {
                        returnArray = recoverQuestion(field, surveyJSONObject);
                        questionsAnswersArray.push({
                            'questionId': returnArray['questionId'],
                            'questionName': returnArray['questionName'],
                            'answerValue': returnArray['answerValue']
                        });
                    }
                });

                /**
                 * Adding a question structure
                 * 
                 * @param {type} i
                 * @param {type} questionsAnswers
                 * @returns {undefined}
                 */
                var flyingId = 0;
                $.each(questionsAnswersArray, function (i, questionsAnswers) {
                    if (flyingId != questionsAnswers['questionId']) {
                        values += '\
                        <li>\n\
                        <strong>' + index + '</strong>\n\
                        <h5>' + questionsAnswers['questionName'] + '</h5>\n\
                        <p>\n\
                        <p id="review_message_' + questionsAnswers['questionId'] + '"></p>\n\
                        </p>\n\
                        </li>';
                        index++;
                    }
                    flyingId = questionsAnswers['questionId'];
                });
                $("#summaryContent").html(values);

                /**
                 * Loading answers
                 * 
                 * @param {type} i
                 * @param {type} questionsAnswers
                 * @returns {undefined}
                 */
                $.each(questionsAnswersArray, function (i, questionsAnswers) {

                    var questionId = questionsAnswers['questionId'];
                    var divId = '#review_message_' + questionId;

                    $(divId).append(questionsAnswers['answerValue'] + ', ');
                });

                /**
                 * Flush last character if comma
                 * 
                 * @param {type} i
                 * @param {type} questionsAnswers
                 * @returns {undefined}
                 */
                var flyingId = 0;
                $.each(questionsAnswersArray, function (i, questionsAnswers) {
                    if (flyingId != questionsAnswers['questionId']) {
                        var questionId = questionsAnswers['questionId'];
                        var divId = '#review_message_' + questionId;

                        var str = $(divId).text();
                        console.log('str ' + str);
                        var newStr = removeLastComma(str);
                        console.log('newStr ' + newStr);
                        $(divId).html(newStr);
                    }
                    flyingId = questionsAnswers['questionId'];
                });

            }
        }



    }); // $(function () END

    /**
     * @param {type} field
     * 
     * @returns {Number}     
     */
    function recoverQuestion(field, surveyJSONObject) {
        var fieldNameArray = field.name.split("##");
        var returnArray = {
            'questionName': '',
            'questionId': '',
            'answerValue': ''};
        if (fieldNameArray !== null) {
            var recoverQuestionIdRaw = fieldNameArray[1];
            var recoverQuestionId = recoverQuestionIdRaw.replace(/[^a-zA-Z0-9]/g, '');
            var questionArray = surveyJSONObject['question'][recoverQuestionId];
            returnArray['questionName'] = questionArray['name'];
            returnArray['questionId'] = recoverQuestionId;
            /**
             * 3 => 'Text',
             */
            if (questionArray['type'] == 3) {
                returnArray['answerValue'] = field.value;
            } else {
                questionArray['answer'].forEach((element) => {
                    if (element['id'] == field.value) {
                        returnArray['answerValue'] = element['name'];
                    }
                });
            }
        }

        return returnArray;
    }

    /**
     * @param {type} field
     * 
     * @returns {Number}     
     */
    function recoverQuestionId(field) {
        var fieldNameArray = field.name.split("##");
        if (fieldNameArray !== null) {
            var recoverQuestionIdRaw = (fieldNameArray[1]);
            var recoverQuestionId = recoverQuestionIdRaw.replace(/[^a-zA-Z0-9]/g, '');
            return recoverQuestionId;
        }
    }

    /**
     * @param {type} strng
     * 
     * @returns {unresolved}
     */
    function removeLastComma(strng) {
        var n = strng.lastIndexOf(",");
        var newStrng = strng.substring(0, n);
        return newStrng;
    }
</script>