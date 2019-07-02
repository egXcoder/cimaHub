Set WinScriptHost = CreateObject("WScript.Shell")

WinScriptHost.Run "C:\xampp\php\php.exe C:\xampp\htdocs\cinemaHub\artisan movies:fetch/", 0

Set WinScriptHost = Nothing