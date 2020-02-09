define("ace/mode/nsis_highlight_rules", ["require", "exports", "module", "ace/lib/oop", "ace/mode/text_highlight_rules"], function (e, t, n) {
    "use strict";
    var r = e("../lib/oop"), i = e("./text_highlight_rules").TextHighlightRules, s = function () {
        this.$rules = {
            start: [{
                token: "keyword.compiler.nsis",
                regex: /^\s*!(?:include|addincludedir|addplugindir|appendfile|cd|delfile|echo|error|execute|packhdr|pragma|finalize|getdllversion|gettlbversion|system|tempfile|warning|verbose|define|undef|insertmacro|macro|macroend|makensis|searchparse|searchreplace)\b/,
                caseInsensitive: !0
            }, {
                token: "keyword.command.nsis",
                regex: /^\s*(?:Abort|AddBrandingImage|AddSize|AllowRootDirInstall|AllowSkipFiles|AutoCloseWindow|BGFont|BGGradient|BrandingText|BringToFront|Call|CallInstDLL|Caption|ChangeUI|CheckBitmap|ClearErrors|CompletedText|ComponentText|CopyFiles|CRCCheck|CreateDirectory|CreateFont|CreateShortCut|Delete|DeleteINISec|DeleteINIStr|DeleteRegKey|DeleteRegValue|DetailPrint|DetailsButtonText|DirText|DirVar|DirVerify|EnableWindow|EnumRegKey|EnumRegValue|Exch|Exec|ExecShell|ExecShellWait|ExecWait|ExpandEnvStrings|File|FileBufSize|FileClose|FileErrorText|FileOpen|FileRead|FileReadByte|FileReadUTF16LE|FileReadWord|FileWriteUTF16LE|FileSeek|FileWrite|FileWriteByte|FileWriteWord|FindClose|FindFirst|FindNext|FindWindow|FlushINI|GetCurInstType|GetCurrentAddress|GetDlgItem|GetDLLVersion|GetDLLVersionLocal|GetErrorLevel|GetFileTime|GetFileTimeLocal|GetFullPathName|GetFunctionAddress|GetInstDirError|GetLabelAddress|GetTempFileName|Goto|HideWindow|Icon|IfAbort|IfErrors|IfFileExists|IfRebootFlag|IfSilent|InitPluginsDir|InstallButtonText|InstallColors|InstallDir|InstallDirRegKey|InstProgressFlags|InstType|InstTypeGetText|InstTypeSetText|Int64Cmp|Int64CmpU|Int64Fmt|IntCmp|IntCmpU|IntFmt|IntOp|IntPtrCmp|IntPtrCmpU|IntPtrOp|IsWindow|LangString|LicenseBkColor|LicenseData|LicenseForceSelection|LicenseLangString|LicenseText|LoadLanguageFile|LockWindow|LogSet|LogText|ManifestDPIAware|ManifestSupportedOS|MessageBox|MiscButtonText|Name|Nop|OutFile|Page|PageCallbacks|PEDllCharacteristics|PESubsysVer|Pop|Push|Quit|ReadEnvStr|ReadINIStr|ReadRegDWORD|ReadRegStr|Reboot|RegDLL|Rename|RequestExecutionLevel|ReserveFile|Return|RMDir|SearchPath|SectionGetFlags|SectionGetInstTypes|SectionGetSize|SectionGetText|SectionIn|SectionSetFlags|SectionSetInstTypes|SectionSetSize|SectionSetText|SendMessage|SetAutoClose|SetBrandingImage|SetCompress|SetCompressor|SetCompressorDictSize|SetCtlColors|SetCurInstType|SetDatablockOptimize|SetDateSave|SetDetailsPrint|SetDetailsView|SetErrorLevel|SetErrors|SetFileAttributes|SetFont|SetOutPath|SetOverwrite|SetRebootFlag|SetRegView|SetShellVarContext|SetSilent|ShowInstDetails|ShowUninstDetails|ShowWindow|SilentInstall|SilentUnInstall|Sleep|SpaceTexts|StrCmp|StrCmpS|StrCpy|StrLen|SubCaption|Unicode|UninstallButtonText|UninstallCaption|UninstallIcon|UninstallSubCaption|UninstallText|UninstPage|UnRegDLL|Var|VIAddVersionKey|VIFileVersion|VIProductVersion|WindowIcon|WriteINIStr|WriteRegBin|WriteRegDWORD|WriteRegExpandStr|WriteRegMultiStr|WriteRegNone|WriteRegStr|WriteUninstaller|XPStyle)\b/,
                caseInsensitive: !0
            }, {
                token: "keyword.control.nsis",
                regex: /^\s*!(?:ifdef|ifndef|if|ifmacrodef|ifmacrondef|else|endif)\b/,
                caseInsensitive: !0
            }, {
                token: "keyword.plugin.nsis",
                regex: /^\s*\w+::\w+/,
                caseInsensitive: !0
            }, {token: "keyword.operator.comparison.nsis", regex: /[!<>]?=|<>|<|>/}, {
                token: "support.function.nsis",
                regex: /(?:\b|^\s*)(?:Function|FunctionEnd|Section|SectionEnd|SectionGroup|SectionGroupEnd|PageEx|PageExEnd)\b/,
                caseInsensitive: !0
            }, {token: "support.library.nsis", regex: /\${[\w\.:-]+}/}, {
                token: "constant.nsis",
                regex: /\b(?:ARCHIVE|FILE_ATTRIBUTE_ARCHIVE|FILE_ATTRIBUTE_HIDDEN|FILE_ATTRIBUTE_NORMAL|FILE_ATTRIBUTE_OFFLINE|FILE_ATTRIBUTE_READONLY|FILE_ATTRIBUTE_SYSTEM|FILE_ATTRIBUTE_TEMPORARY|HIDDEN|HKCC|HKCR(32|64)?|HKCU(32|64)?|HKDD|HKEY_CLASSES_ROOT|HKEY_CURRENT_CONFIG|HKEY_CURRENT_USER|HKEY_DYN_DATA|HKEY_LOCAL_MACHINE|HKEY_PERFORMANCE_DATA|HKEY_USERS|HKLM(32|64)?|HKPD|HKU|IDABORT|IDCANCEL|IDD_DIR|IDD_INST|IDD_INSTFILES|IDD_LICENSE|IDD_SELCOM|IDD_UNINST|IDD_VERIFY|IDIGNORE|IDNO|IDOK|IDRETRY|IDYES|MB_ABORTRETRYIGNORE|MB_DEFBUTTON1|MB_DEFBUTTON2|MB_DEFBUTTON3|MB_DEFBUTTON4|MB_ICONEXCLAMATION|MB_ICONINFORMATION|MB_ICONQUESTION|MB_ICONSTOP|MB_OK|MB_OKCANCEL|MB_RETRYCANCEL|MB_RIGHT|MB_RTLREADING|MB_SETFOREGROUND|MB_TOPMOST|MB_USERICON|MB_YESNO|MB_YESNOCANCEL|NORMAL|OFFLINE|READONLY|SHCTX|SHELL_CONTEXT|SW_HIDE|SW_SHOWDEFAULT|SW_SHOWMAXIMIZED|SW_SHOWMINIMIZED|SW_SHOWNORMAL|SYSTEM|TEMPORARY)\b/,
                caseInsensitive: !0
            }, {
                token: "constant.library.nsis",
                regex: /\${(?:AtLeastServicePack|AtLeastWin7|AtLeastWin8|AtLeastWin10|AtLeastWin95|AtLeastWin98|AtLeastWin2000|AtLeastWin2003|AtLeastWin2008|AtLeastWin2008R2|AtLeastWinME|AtLeastWinNT4|AtLeastWinVista|AtLeastWinXP|AtMostServicePack|AtMostWin7|AtMostWin8|AtMostWin10|AtMostWin95|AtMostWin98|AtMostWin2000|AtMostWin2003|AtMostWin2008|AtMostWin2008R2|AtMostWinME|AtMostWinNT4|AtMostWinVista|AtMostWinXP|IsDomainController|IsNT|IsServer|IsServicePack|IsWin7|IsWin8|IsWin10|IsWin95|IsWin98|IsWin2000|IsWin2003|IsWin2008|IsWin2008R2|IsWinME|IsWinNT4|IsWinVista|IsWinXP)}/
            }, {
                token: "constant.language.boolean.true.nsis",
                regex: /\b(?:true|on)\b/
            }, {
                token: "constant.language.boolean.false.nsis",
                regex: /\b(?:false|off)\b/
            }, {
                token: "constant.language.option.nsis",
                regex: /(?:\b|^\s*)(?:(?:un\.)?components|(?:un\.)?custom|(?:un\.)?directory|(?:un\.)?instfiles|(?:un\.)?license|uninstConfirm|admin|all|auto|both|bottom|bzip2|current|force|hide|highest|ifdiff|ifnewer|lastused|leave|left|listonly|lzma|nevershow|none|normal|notset|right|show|silent|silentlog|textonly|top|try|user|Win10|Win7|Win8|WinVista|zlib)\b/,
                caseInsensitive: !0
            }, {
                token: "constant.language.slash-option.nsis",
                regex: /\b\/(?:a|BRANDING|CENTER|COMPONENTSONLYONCUSTOM|CUSTOMSTRING=|date|e|ENABLECANCEL|FILESONLY|file|FINAL|GLOBAL|gray|ifempty|ifndef|ignorecase|IMGID=|ITALIC|LANG=|NOCUSTOM|noerrors|NONFATAL|nonfatal|oname=|o|REBOOTOK|redef|RESIZETOFIT|r|SHORT|SILENT|SOLID|STRIKE|TRIM|UNDERLINE|utcdate|windows|x)\b/,
                caseInsensitive: !0
            }, {
                token: "constant.numeric.nsis",
                regex: /\b(?:0(?:x|X)[0-9a-fA-F]+|[0-9]+(?:\.[0-9]+)?)\b/
            }, {token: "entity.name.function.nsis", regex: /\$\([\w\.:-]+\)/}, {
                token: "storage.type.function.nsis",
                regex: /\$\w+/
            }, {
                token: "punctuation.definition.string.begin.nsis",
                regex: /`/,
                push: [{
                    token: "punctuation.definition.string.end.nsis",
                    regex: /`/,
                    next: "pop"
                }, {token: "constant.character.escape.nsis", regex: /\$\\./}, {defaultToken: "string.quoted.back.nsis"}]
            }, {
                token: "punctuation.definition.string.begin.nsis",
                regex: /"/,
                push: [{
                    token: "punctuation.definition.string.end.nsis",
                    regex: /"/,
                    next: "pop"
                }, {
                    token: "constant.character.escape.nsis",
                    regex: /\$\\./
                }, {defaultToken: "string.quoted.double.nsis"}]
            }, {
                token: "punctuation.definition.string.begin.nsis",
                regex: /'/,
                push: [{
                    token: "punctuation.definition.string.end.nsis",
                    regex: /'/,
                    next: "pop"
                }, {
                    token: "constant.character.escape.nsis",
                    regex: /\$\\./
                }, {defaultToken: "string.quoted.single.nsis"}]
            }, {
                token: ["punctuation.definition.comment.nsis", "comment.line.nsis"],
                regex: /(;|#)(.*$)/
            }, {
                token: "punctuation.definition.comment.nsis",
                regex: /\/\*/,
                push: [{
                    token: "punctuation.definition.comment.nsis",
                    regex: /\*\//,
                    next: "pop"
                }, {defaultToken: "comment.block.nsis"}]
            }, {token: "text", regex: /(?:!include|!insertmacro)\b/}]
        }, this.normalizeRules()
    };
    s.metaData = {
        comment: "\n	todo: - highlight functions\n	",
        fileTypes: ["nsi", "nsh"],
        name: "NSIS",
        scopeName: "source.nsis"
    }, r.inherits(s, i), t.NSISHighlightRules = s
}), define("ace/mode/folding/cstyle", ["require", "exports", "module", "ace/lib/oop", "ace/range", "ace/mode/folding/fold_mode"], function (e, t, n) {
    "use strict";
    var r = e("../../lib/oop"), i = e("../../range").Range, s = e("./fold_mode").FoldMode,
        o = t.FoldMode = function (e) {
            e && (this.foldingStartMarker = new RegExp(this.foldingStartMarker.source.replace(/\|[^|]*?$/, "|" + e.start)), this.foldingStopMarker = new RegExp(this.foldingStopMarker.source.replace(/\|[^|]*?$/, "|" + e.end)))
        };
    r.inherits(o, s), function () {
        this.foldingStartMarker = /([\{\[\(])[^\}\]\)]*$|^\s*(\/\*)/, this.foldingStopMarker = /^[^\[\{\(]*([\}\]\)])|^[\s\*]*(\*\/)/, this.singleLineBlockCommentRe = /^\s*(\/\*).*\*\/\s*$/, this.tripleStarBlockCommentRe = /^\s*(\/\*\*\*).*\*\/\s*$/, this.startRegionRe = /^\s*(\/\*|\/\/)#?region\b/, this._getFoldWidgetBase = this.getFoldWidget, this.getFoldWidget = function (e, t, n) {
            var r = e.getLine(n);
            if (this.singleLineBlockCommentRe.test(r) && !this.startRegionRe.test(r) && !this.tripleStarBlockCommentRe.test(r)) return "";
            var i = this._getFoldWidgetBase(e, t, n);
            return !i && this.startRegionRe.test(r) ? "start" : i
        }, this.getFoldWidgetRange = function (e, t, n, r) {
            var i = e.getLine(n);
            if (this.startRegionRe.test(i)) return this.getCommentRegionBlock(e, i, n);
            var s = i.match(this.foldingStartMarker);
            if (s) {
                var o = s.index;
                if (s[1]) return this.openingBracketBlock(e, s[1], n, o);
                var u = e.getCommentFoldRange(n, o + s[0].length, 1);
                return u && !u.isMultiLine() && (r ? u = this.getSectionRange(e, n) : t != "all" && (u = null)), u
            }
            if (t === "markbegin") return;
            var s = i.match(this.foldingStopMarker);
            if (s) {
                var o = s.index + s[0].length;
                return s[1] ? this.closingBracketBlock(e, s[1], n, o) : e.getCommentFoldRange(n, o, -1)
            }
        }, this.getSectionRange = function (e, t) {
            var n = e.getLine(t), r = n.search(/\S/), s = t, o = n.length;
            t += 1;
            var u = t, a = e.getLength();
            while (++t < a) {
                n = e.getLine(t);
                var f = n.search(/\S/);
                if (f === -1) continue;
                if (r > f) break;
                var l = this.getFoldWidgetRange(e, "all", t);
                if (l) {
                    if (l.start.row <= s) break;
                    if (l.isMultiLine()) t = l.end.row; else if (r == f) break
                }
                u = t
            }
            return new i(s, o, u, e.getLine(u).length)
        }, this.getCommentRegionBlock = function (e, t, n) {
            var r = t.search(/\s*$/), s = e.getLength(), o = n, u = /^\s*(?:\/\*|\/\/|--)#?(end)?region\b/, a = 1;
            while (++n < s) {
                t = e.getLine(n);
                var f = u.exec(t);
                if (!f) continue;
                f[1] ? a-- : a++;
                if (!a) break
            }
            var l = n;
            if (l > o) return new i(o, r, l, t.length)
        }
    }.call(o.prototype)
}), define("ace/mode/nsis", ["require", "exports", "module", "ace/lib/oop", "ace/mode/text", "ace/mode/nsis_highlight_rules", "ace/mode/folding/cstyle"], function (e, t, n) {
    "use strict";
    var r = e("../lib/oop"), i = e("./text").Mode, s = e("./nsis_highlight_rules").NSISHighlightRules,
        o = e("./folding/cstyle").FoldMode, u = function () {
            this.HighlightRules = s, this.foldingRules = new o, this.$behaviour = this.$defaultBehaviour
        };
    r.inherits(u, i), function () {
        this.lineCommentStart = [";", "#"], this.blockComment = {start: "/*", end: "*/"}, this.$id = "ace/mode/nsis"
    }.call(u.prototype), t.Mode = u
});
(function () {
    window.require(["ace/mode/nsis"], function (m) {
        if (typeof module == "object" && typeof exports == "object" && module) {
            module.exports = m;
        }
    });
})();
            