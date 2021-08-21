import {
    addQuestionItem,
    removeQuestionItem,
    showQuestionItem
} from './components/question_item'

import {
    addChoiceItem,
    removeChoiceItem
} from './components/choice_item'

import {
    addErrorQuestion,
    removeErrorQuestion
} from './components/error_question'

(function () {
    'use strict'

    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.querySelectorAll('.needs-validation')

    // Loop over them and prevent submission
    Array.prototype.slice.call(forms)
        .forEach(function (form) {
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()

                    removeErrorQuestion({})

                    const questionItemByTitle = $('.question-title-input:invalid').parents('.question-form')
                    for (let index = questionItemByTitle.length - 1; index >= 0; index--) {
                        const element = questionItemByTitle[index];
                        const questionNum = $(element).attr('data-question-num');
                        const questionId = $(element).data('questionId');
                        addErrorQuestion({
                            id: questionId,
                            text: `لطفا عنوان سوال ${questionNum} را تکمیل کنید`,
                            type: 'title'
                        })
                    }

                    const questionItemByChoice = $('.choice-input:invalid').parents('.question-form')
                    for (let index = questionItemByChoice.length - 1; index >= 0; index--) {
                        const element = questionItemByChoice[index];
                        const questionNum = $(element).attr('data-question-num');
                        const questionId = $(element).data('questionId');
                        addErrorQuestion({
                            id: questionId,
                            text: `لطفا گزینه های سوال ${questionNum} را تکمیل کنید`,
                            type: 'choice'

                        })
                    }
                }

                form.classList.add('was-validated')
            }, false)
        })
})()

$(document).ready(function () {
    for (let index = 0; index < questions.length; index++) {
        const question = questions[index];
        console.log(question);
        addQuestionItem({
            createId: question.id,
            title: question.title,
            description: question.description,
            has_choice: question.has_choice,
            has_descriptive: question.has_descriptive,
            has_multiple_choice: question.has_multiple_choice,
            choice_count: question.choice_count,
            mode: 'edit'
        })

        if (question.has_choice == 1) {
            const parent = $(`#question-box-${question.id}`)
            parent.find('.multiple-choice-container').attr('aria-hidden', false)
            parent.find('.choice-container').attr('aria-hidden', false)
            parent.find('.choice-input').prop('disabled', false);
        }
    }

    for (let index = 0; index < choices.length; index++) {
        const choice = choices[index];
        addChoiceItem({
            createId: choice.id,
            questionId: choice.question_id,
            questionMode: 'edit',
            title: choice.title,
            mode: 'edit',
            hasDisabled: false
        })
    }
})

$(document).on('click', '.question-add-box', function () {
    addQuestionItem({
        mode: 'add'
    })

    $('form').removeClass('was-validated')
})

$(document).on('click', '.question-item-delete', function () {
    removeQuestionItem({
        id: $(this).parents('.question-container').data('questionId'),
        questionMode: $(this).parents('.question-container').data('questionMode'),
        mode: 'delete'
    })
})

$(document).on('click', '.question-item-box', function () {
    showQuestionItem({
        id: $(this).parents('.question-container').data('questionId'),
        mode: 'show'
    })
})

$(document).on('click', '.choice-add-box', function () {
    addChoiceItem({
        questionId: $(this).parents('.question-form').data('questionId'),
        questionMode: $(this).parents('.question-form').data('questionMode'),
        mode: 'add'
    })
})

$(document).on('click', '.choice-item-delete', function () {
    removeChoiceItem({
        id: $(this).parents('.choice-container').data('choiceId'),
        questionId: $(this).parents('.question-form').data('questionId'),
        questionMode: $(this).parents('.question-form').data('questionMode'),
        mode: 'add'
    })
})

$(document).on('input', '.question-title-input', function () {
    const questionId = $(this).parents('.question-form').data('questionId')
    const questionItemTitle = $(`.question-container[data-question-id="${questionId}"]`).find('.question-item-title')
    if ($(this).val() == '') {
        questionItemTitle.text('عنوان سوال');
        return false;
    }
    questionItemTitle.text($(this).val())
})

$(document).on('change', '.has-choice-input', function () {
    const parent = $(this).parents('.question-form')
    if ($(this).is(':checked')) {
        parent.find('.multiple-choice-container').attr('aria-hidden', false)
        parent.find('.has-multiple-choice-input').prop('disabled', false);
        parent.find('.choice-container').attr('aria-hidden', false)
        parent.find('.choice-input').prop('disabled', false);
        return true;
    }

    if (!parent.find('.has-descriptive-input').is(':checked')) {
        parent.find('.has-descriptive-input').prop('checked', true)
    }
    parent.find('.multiple-choice-container').attr('aria-hidden', true)
    parent.find('.has-multiple-choice-input').prop('disabled', true);

    parent.find('.choice-container').attr('aria-hidden', true)
    parent.find('.choice-input').prop('disabled', true);

})

$(document).on('change', '.has-descriptive-input', function () {
    const parent = $(this).parents('.question-form')
    if ($(this).is(':checked')) {
        return true;
    }

    if (!parent.find('.has-choice-input').is(':checked')) {
        parent.find('.has-choice-input').prop('checked', true)
        parent.find('.multiple-choice-container').attr('aria-hidden', false)
        parent.find('.has-multiple-choice-input').prop('disabled', false);

        parent.find('.choice-container').attr('aria-hidden', false)
        parent.find('.choice-input').prop('disabled', false);
    }
})
