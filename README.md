Q1. Your form sends data with POST rather than GET. Explain what would go wrong if it used GET instead. Your answer should say something about what a browser does when a page is refreshed.

Answer: If my form used GET, the data would sit in the URL, and a browser treats GET as safe to repeat. When a page is refreshed, the browser just sends the last request again, so every refresh would silently save another duplicate record. POST makes the browser ask for confirmation first, and GET is for reading while POST is for changing data.

Q2. When validation fails, your controller does not run the code that saves the record — and you did not write an if statement to stop it. Explain what actually stops it, and where the visitor ends up.

Answer: $request->validate() stops it. When a rule fails, it throws an exception, so the method ends right there and the saving code never runs. Laravel catches that exception and sends the visitor back to the form, with the error messages and their old input.   


Q3. Your success message is displayed from the layout, which renders on every page. Explain why it does not appear on every page.

Answer: The layout runs on every page, but the @if(session('success')) check only passes when a message is in the session. I set it with ->with('success', ...) on the redirect, so it's flash data that lasts for only the next request. After that page loads, it's removed, so every other page has nothing to show.
