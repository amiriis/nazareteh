import {
    addQuestionBox,
    removeQuestionBox
} from './question_box'

export function addQuestionItem({
    createId,
    mode
}) {
    const id = (mode == 'add') ? ($('.question-container').last().data('questionId') ?? 0) + 1 : createId

    let content = `<div class="d-flex question-container my-2" id="question-item-${id}" data-question-id="${id}">
                        <div class="col-11 d-flex align-items-center question-item-box">
                            <span class="col p-2 text-center question-item-num"></span>
                            <span class="col-11 p-2 question-item-title">عنوان سوال</span>
                        </div>
                        <div class="col-1 d-flex align-items-center justify-content-center question-item-delete">
                            <i class="bi-trash"></i>
                        </div>
                    </div>`

    $('.questions-box').append(content)
    addQuestionBox({
        id: id,
        mode: mode
    })
    updateQuestionItemNum()
    activeQusetionItem({
        id: id,
        mode: mode
    })
}

export function removeQuestionItem({
    id,
    mode
}) {
    activeQusetionItem({
        id: id,
        mode: mode
    })
    $(`#question-item-${id}`).remove()
    removeQuestionBox({
        id: id,
        mode: mode
    })
    updateQuestionItemNum()
}

export function showQuestionItem({
    id,
    mode
}) {
    activeQusetionItem({
        id: id,
        mode: mode
    })
}

function updateQuestionItemNum() {
    const questionItems = $('.question-container')
    for (let index = 0; index < questionItems.length; index++) {
        let id = $(questionItems[index]).data('questionId')
        $(questionItems[index]).find('.question-item-num').text(index + 1)
        $(`#question-box-${id}`).find('.question-item-num').text(`(${index + 1})`)
        $(`#question-box-${id}`).attr('data-question-num', index + 1)
    }
}

function activeQusetionItem({
    id,
    mode
}) {
    if (mode == 'add') {

        $('.question-item-box').removeClass('active')
        $(`.question-container[data-question-id="${id}"]`).find('.question-item-box').addClass('active')

        $(`.question-form`).attr('aria-hidden', true);
        $(`#question-box-${id}`).attr('aria-hidden', false)


        return true;

    } else if (mode == 'delete') {
        if ($(`.question-container[data-question-id="${id}"]`).find('.question-item-box.active').length == 1) {

            $('.question-item-box').removeClass('active')

            let currentId = $(`.question-container[data-question-id="${id}"]`).prev().data('questionId')

            $(`.question-container[data-question-id="${currentId}"]`).find('.question-item-box').addClass('active')

            $(`.question-form`).attr('aria-hidden', true);
            $(`#question-box-${currentId}`).attr('aria-hidden', false)

            return true;
        }
    } else if (mode == 'show') {
        $('.question-item-box').removeClass('active')
        $(`.question-container[data-question-id="${id}"]`).find('.question-item-box').addClass('active')

        $(`.question-form`).attr('aria-hidden', true);
        $(`#question-box-${id}`).attr('aria-hidden', false)

        return true;
    }
}
