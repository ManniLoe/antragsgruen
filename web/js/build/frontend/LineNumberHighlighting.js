define(["require","exports"],function(e,i){"use strict";Object.defineProperty(i,"__esModule",{value:!0});var t=function(){return function(){var e=$(".gotoLineNumerPanel"),i=e.find("input[name=lineNumber]"),t=!1;window.addEventListener("keypress",function(n){if(!t&&n.charCode>=48&&n.charCode<=57){var o=$(n.target);if(o.is("input, textarea")||o.parents("input, textarea").length>0)return;e.addClass("active"),t=!0,i.focus(),window.setTimeout(function(){i.val(n.key)},1)}t&&e.find(".lineNumberNotFound").addClass("hidden")}),e.on("submit",function(n){n.preventDefault();var o=i.val();if(""===o)return e.removeClass("active"),void(t=!1);var a=$(".lineNumber[data-line-number="+o+"]");0!==a.length?(e.removeClass("active"),t=!1,a.scrollintoview({top_offset:-100}),a.addClass("highlighted"),window.setTimeout(function(){a.addClass("highlighted-active")},50),window.setTimeout(function(){a.removeClass("highlighted-active")},2e3),window.setTimeout(function(){a.removeClass("highlighted")},2500)):e.find(".lineNumberNotFound").removeClass("hidden")})}}();i.LineNumberHighlighting=t});
//# sourceMappingURL=LineNumberHighlighting.js.map
