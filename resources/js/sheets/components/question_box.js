import {
    addChoiceItem
} from './choice_item'

export function addQuestionBox({
    id,
    mode
}) {
    let content = `<div class="question-form" id="question-box-${id}" data-question-mode="${mode}" data-question-id="${id}" data-question-num="" aria-hidden="true">
                        <input type="hidden"
                        name="question[${mode}][${id}][id]"
                        value="${id}"/>
                        <div class="d-flex justify-content-center">
                            <span class="h5">جزئیات سوال <small class="question-item-num"></small></span>
                        </div>
                        <div class="question-content py-3">
                            <div class="form-floating mb-3">
                                <input type="text"
                                class="form-control question-title-input"
                                id="question[${mode}][${id}][title]"
                                name="question[${mode}][${id}][title]"
                                    placeholder="عنوان سوال" required>
                                <label for="question[${mode}][${id}][title]">عنوان</label>
                                <div class="invalid-feedback">
                                    لطفا عنوان سوال را وارد نمایید
                                </div>
                            </div>
                            <div class="form-floating">
                                <textarea textarea class = "form-control"
                                id = "question[${mode}][${id}][description]"
                                name = "question[${mode}][${id}][description]"
                                style = "height: 100px"
                                    placeholder="توضیحات سوال"></textarea>
                                <label for="question[${mode}][${id}][description]">توضیحات</label>
                                <div id="descriptionQuestionHelp" class="form-text">(اختیاری)
                                در صورت نیاز به توضیح بیشتر از این بخش استفاده کنید
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center mt-3">
                            <span class="h5">تنظیمات سوال <small class="question-item-num"></small></span>
                        </div>
                        <div class="question-content py-3">
                            <div id="descriptionQuestionHelp" class="form-text mb-3">حداقل باید یک نوع پاسخ انتخاب کنید
                            </div>
                            <div class="form-check form-switch mb-3">
                                <input checked class="has-descriptive-input form-check-input" type="checkbox" id="question[${mode}][${id}][has_descriptive]"
                                    name="question[${mode}][${id}][has_descriptive]">
                                <label class="form-check-label" for="question[${mode}][${id}][has_descriptive]">دارای پاسخ تشریحی می باشد</label>
                            </div>
                            <div class="form-check form-switch mb-4">
                                <input class="has-choice-input form-check-input" type="checkbox" id="question[${mode}][${id}][has_choice]" name="question[${mode}][${id}][has_choice]">
                                <label class="form-check-label" for="question[${mode}][${id}][has_choice]">دارای پاسخ گزینه ای می باشد</label>
                            </div>
                            <div class="multiple-choice-container form-check form-switch mb-3"
                            aria-hidden="true">
                                <input class="form-check-input" type="checkbox" id="question[${mode}][${id}][has_multiple_choice]"
                                    name="question[${mode}][${id}][has_multiple_choice]">
                                <label class="form-check-label"
                                for="question[${mode}][${id}][has_multiple_choice]" > دارای چند انتخاب هم زمان می
                                    باشد</label>
                            </div>
                        </div>
                        <div class="choice-container"
                        aria-hidden="true">
                            <div class="d-flex justify-content-center mt-3">
                                <span class="h5">گزینه های سوال <small class="question-item-num"></small></span>
                            </div>
                            <div class="question-content py-3">
                                <div class="choices-box-${id}"></div>
                                <div class="d-flex align-items-center choice-add-box my-2">
                                    <span class="col text-center p-1"><i class="bi-plus-lg"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>`

    $('.question-forms').append(content)

    addChoiceItem({
        questionId: id,
        questionMode: mode,
        mode: 'add',
        hasDisabled: true
    })
}


export function removeQuestionBox({
    id,
    mode
}) {
    $(`#question-box-${id}`).remove()
}
