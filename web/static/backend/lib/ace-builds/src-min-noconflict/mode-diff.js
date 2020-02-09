ace.define("ace/mode/diff_highlight_rules", ["require", "exports", "module", "ace/lib/oop", "ace/mode/text_highlight_rules"], function (e, t, n) {
    "use strict";
    var r = e("../lib/oop"), i = e("./text_highlight_rules").TextHighlightRules, s = function () {
        this.$rules = {
            start: [{
                regex: "^(?:\\*{15}|={67}|-{3}|\\+{3})$",
                token: "punctuation.definition.separator.diff",
                name: "keyword"
            }, {
                regex: "^(@@)(\\s*.+?\\s*)(@@)(.*)$",
                token: ["constant", "constant.numeric", "constant", "comment.doc.tag"]
            }, {
                regex: "^(\\d+)([,\\d]+)(a|d|c)(\\d+)([,\\d]+)(.*)$",
                token: ["constant.numeric", "punctuation.definition.range.diff", "constant.function", "constant.numeric", "punctuation.definition.range.diff", "invalid"],
                name: "meta."
            }, {
                regex: "^(\\-{3}|\\+{3}|\\*{3})( .+)$",
                token: ["constant.numeric", "meta.tag"]
            }, {
                regex: "^([!+>])(.*?)(\\s*)$",
                token: ["support.constant", "text", "invalid"]
            }, {
                regex: "^([<\\-])(.*?)(\\s*)$",
                token: ["support.function", "string", "invalid"]
            }, {
                regex: "^(diff)(\\s+--\\w+)?(.+?)( .+)?$",
                token: ["variable", "variable", "keyword", "variable"]
            }, {regex: "^Index.+$", token: "variable"}, {regex: "^\\s+$", token: "text"}, {
                regex: "\\s*$",
                token: "invalid"
            }, {defaultToken: "invisible", caseInsensitive: !0}]
        }
    };
    r.inherits(s, i), t.DiffHighlightRules = s
}), ace.define("ace/mode/folding/diff", ["require", "exports", "module", "ace/lib/oop", "ace/mode/folding/fold_mode", "ace/range"], function (e, t, n) {
    "use strict";
    var r = e("../../lib/oop"), i = e("./fold_mode").FoldMode, s = e("../../range").Range,
        o = t.FoldMode = function (e, t) {
            this.regExpList = e, this.flag = t, this.foldingStartMarker = RegExp("^(" + e.join("|") + ")", this.flag)
        };
    r.inherits(o, i), function () {
        this.getFoldWidgetRange = function (e, t, n) {
            var r = e.getLine(n), i = {row: n, column: r.length}, o = this.regExpList;
            for (var u = 1; u <= o.length; u++) {
                var a = RegExp("^(" + o.slice(0, u).join("|") + ")", this.flag);
                if (a.test(r)) break
            }
            for (var f = e.getLength(); ++n < f;) {
                r = e.getLine(n);
                if (a.test(r)) break
            }
            if (n == i.row + 1) return;
            return new s(i.row, i.column, n - 1, r.length)
        }
    }.call(o.prototype)
}), ace.define("ace/mode/diff", ["require", "exports", "module", "ace/lib/oop", "ace/mode/text", "ace/mode/diff_highlight_rules", "ace/mode/folding/diff"], function (e, t, n) {
    "use strict";
    var r = e("../lib/oop"), i = e("./text").Mode, s = e("./diff_highlight_rules").DiffHighlightRules,
        o = e("./folding/diff").FoldMode, u = function () {
            this.HighlightRules = s, this.foldingRules = new o(["diff", "@@|\\*{5}"], "i")
        };
    r.inherits(u, i), function () {
        this.$id = "ace/mode/diff"
    }.call(u.prototype), t.Mode = u
});
(function () {
    ace.require(["ace/mode/diff"], function (m) {
        if (typeof module == "object" && typeof exports == "object" && module) {
            module.exports = m;
        }
    });
})();
            