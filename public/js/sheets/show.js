(()=>{"use strict";function t(t){var e=t.id,i=t.title,n=t.description,a=t.has_choice,s=t.has_descriptive,c=t.has_multiple_choice,o=t.choices,r='<div class="question-container" data-question-num="" data-question-id="'.concat(e,'" aria-hidden="true">\n                <div class="h4 mb-3"><span class="question-num"></span>.<span class="question-title p-1">').concat(i,'</span>\n                </div>\n                <p class="question-description mb-3">').concat(null!=n?n:"","</p>");if(a){if(r+='<div class="list-group mb-3">',c)for(var d=0;d<o.length;d++){var u=o[d];r+='<label class="list-group-item">\n                                <input class="form-check-input input-choice me-2" type="checkbox" name="answers['.concat(e,'][choices][]" value="').concat(u.id,'">').concat(u.title,"</label>")}else for(var p=0;p<o.length;p++){var l=o[p];r+='<label class="list-group-item">\n                                <input class="form-check-input input-choice me-2" type="radio" name="answers['.concat(e,'][choices][]" value="').concat(l.id,'">').concat(l.title,"</label>")}r+="</div>"}s&&(r+='<div class="form-floating">\n                    <textarea class = "form-control textarea-descriptive"\n                    placeholder="پاسخ خود را بنویسید"\n                    id="answers['.concat(e,'][description]" name="answers[').concat(e,'][description]"\n                        style="height: 100px"></textarea>\n                    <label for="answer[').concat(e,'][description]">پاسخ خود را بنویسید</label>\n                </div>\n            </div>')),$(".questions-container").append(r),function(){for(var t=$(".question-container"),e=0;e<t.length;e++)$(t[e]).find(".question-num").text(e+1),$(t[e]).attr("data-question-num",e+1)}()}var e={},i=[],n=0;$((function(){for(var a=0;a<serverToJs.questions.length;a++){var s=serverToJs.questions[a];t({id:s.id,title:s.title,description:s.description,has_choice:s.has_choice,has_descriptive:s.has_descriptive,has_multiple_choice:s.has_multiple_choice,choices:s.choices}),i.push({id:s.id,valid_choice:!s.has_choice,valid_descriptive:!s.has_descriptive})}e={num:1,id:$(".question-container[data-question-num=1]").data("questionId")},n=serverToJs.questions.length,$(".question-total").text(n),$(".question-step").text(e.num),$(".question-container[data-question-id=".concat(e.id,"]")).attr("aria-hidden",!1),$(".previous-step").attr("aria-hidden",!0),e.num==n?$(".next-step").attr("default-text","ارسال و ثبت"):$(".next-step").attr("default-text","بعدی"),$(".next-step").prop("disabled",!0),$(".next-step").text("سوال را جواب دهید")})),$(document).on("click",".next-step",(function(){if(e={num:e.num+1,id:$(".question-container[data-question-num=".concat(e.num+1,"]")).data("questionId")},$(".question-container").attr("aria-hidden",!0),e.num>n)return $(".previous-step").attr("aria-hidden",!0),$(".next-step").attr("aria-hidden",!0),$(".text-message").empty(),$(".text-message").text("در حال ارسال برای ثبت ..."),$("#form_responder_store").submit(),!0;$(".question-container[data-question-id=".concat(e.id,"]")).attr("aria-hidden",!1),1==e.num?$(".previous-step").attr("aria-hidden",!0):$(".previous-step").attr("aria-hidden",!1),e.num==n?$(".next-step").attr("default-text","ارسال و ثبت"):$(".next-step").attr("default-text","بعدی"),$(".question-step").text(e.num),a()})),$(document).on("click",".previous-step",(function(){e={num:e.num-1,id:$(".question-container[data-question-num=".concat(e.num-1,"]")).data("questionId")},$(".question-container").attr("aria-hidden",!0),$(".question-container[data-question-id=".concat(e.id,"]")).attr("aria-hidden",!1),1==e.num?$(".previous-step").attr("aria-hidden",!0):$(".previous-step").attr("aria-hidden",!1),e.num==n?$(".next-step").attr("default-text","ارسال و ثبت"):$(".next-step").attr("default-text","بعدی"),$(".question-step").text(e.num),a()})),$(document).on("change",".input-choice",(function(){var t=i.findIndex((function(t){return t.id==e.id}));$('input[name="'.concat($(this).attr("name"),'"]:checked')).length>0?i[t].valid_choice=!0:i[t].valid_choice=!1,a()})),$(document).on("input",".textarea-descriptive",(function(){var t=i.findIndex((function(t){return t.id==e.id}));""==$(this).val()?i[t].valid_descriptive=!1:i[t].valid_descriptive=!0,a()}));var a=function(){var t=i.find((function(t){return t.id==e.id}));return t.valid_choice&&t.valid_descriptive?($(".next-step").prop("disabled",!1),$(".next-step").text($(".next-step").attr("default-text")),!0):($(".next-step").prop("disabled",!0),$(".next-step").text("سوال را جواب دهید"),!1)}})();
//# sourceMappingURL=show.js.map