var currentQuestion = {};
var validQuestions = [];
var totalQuestions = 0;

import {
    addQuestionContainer
} from "./components/question_container"

$(function () {
    for (let index = 0; index < serverToJs.questions.length; index++) {
        const question = serverToJs.questions[index];
        addQuestionContainer({
            id: question.id,
            title: question.title,
            description: question.description,
            has_choice: question.has_choice,
            has_descriptive: question.has_descriptive,
            has_multiple_choice: question.has_multiple_choice,
            choices: question.choices,
        })

        validQuestions.push({
            id: question.id,
            valid_choice: question.has_choice ? false : true,
            valid_descriptive: question.has_descriptive ? false : true
        })
    }

    currentQuestion = {
        num: 1,
        id: $(`.question-container[data-question-num=1]`).data('questionId')
    }

    totalQuestions = serverToJs.questions.length

    $('.question-total').text(totalQuestions)
    $('.question-step').text(currentQuestion.num)

    $(`.question-container[data-question-id=${currentQuestion.id}]`).attr('aria-hidden', false)

    $('.previous-step').attr('aria-hidden', true)

    if (currentQuestion.num == totalQuestions) {
        $('.next-step').attr('default-text', 'ارسال و ثبت')
    } else {
        $('.next-step').attr('default-text', 'بعدی')
    }

    $('.next-step').prop('disabled', true)
    $('.next-step').text('سوال را جواب دهید')
});

$(document).on('click', '.next-step', function () {
    currentQuestion = {
        num: currentQuestion.num + 1,
        id: $(`.question-container[data-question-num=${currentQuestion.num + 1}]`).data('questionId')
    }

    $(`.question-container`).attr('aria-hidden', true)

    if (currentQuestion.num > totalQuestions) {
        $('.previous-step').attr('aria-hidden', true)
        $('.next-step').attr('aria-hidden', true)
        $('.text-message').empty()
        $('.text-message').text('در حال ارسال برای ثبت ...')
        $('#form_responder_store').submit()

        return true;
    }


    $(`.question-container[data-question-id=${currentQuestion.id}]`).attr('aria-hidden', false)

    if (currentQuestion.num == 1) {
        $('.previous-step').attr('aria-hidden', true)
    } else {
        $('.previous-step').attr('aria-hidden', false)
    }

    if (currentQuestion.num == totalQuestions) {
        $('.next-step').attr('default-text', 'ارسال و ثبت')
    } else {
        $('.next-step').attr('default-text', 'بعدی')
    }

    $('.question-step').text(currentQuestion.num)

    stepValidation()
})

$(document).on('click', '.previous-step', function () {
    currentQuestion = {
        num: currentQuestion.num - 1,
        id: $(`.question-container[data-question-num=${currentQuestion.num - 1}]`).data('questionId')
    }

    $(`.question-container`).attr('aria-hidden', true)

    $(`.question-container[data-question-id=${currentQuestion.id}]`).attr('aria-hidden', false)

    if (currentQuestion.num == 1) {
        $('.previous-step').attr('aria-hidden', true)
    } else {
        $('.previous-step').attr('aria-hidden', false)
    }

    if (currentQuestion.num == totalQuestions) {
        $('.next-step').attr('default-text', 'ارسال و ثبت')
    } else {
        $('.next-step').attr('default-text', 'بعدی')
    }

    $('.question-step').text(currentQuestion.num)

    stepValidation()
})

$(document).on('change', '.input-choice', function () {
    const index = validQuestions.findIndex(question => question.id == currentQuestion.id)
    if ($(`input[name="${$(this).attr('name')}"]:checked`).length > 0)
        validQuestions[index].valid_choice = true
    else
        validQuestions[index].valid_choice = false

    stepValidation()
})

$(document).on('input', `.textarea-descriptive`, function () {
    const index = validQuestions.findIndex(question => question.id == currentQuestion.id)
    if ($(this).val() == '')
        validQuestions[index].valid_descriptive = false
    else
        validQuestions[index].valid_descriptive = true

    stepValidation()
})

const stepValidation = () => {
    const quesiton = validQuestions.find(question => question.id == currentQuestion.id)

    if (quesiton.valid_choice && quesiton.valid_descriptive) {
        $('.next-step').prop('disabled', false)
        $('.next-step').text($('.next-step').attr('default-text'))
        return true
    }

    $('.next-step').prop('disabled', true)
    $('.next-step').text('سوال را جواب دهید')
    return false
}
