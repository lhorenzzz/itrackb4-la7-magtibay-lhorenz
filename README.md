Q1. You added a second filter without adding a single route. Explain why no new route was needed. Your answer should say something about what the router actually looks at.

Answer: I didn't need to add a new route because filters like these usually go through query strings (e.g. ?genre=RPG&platform=PC), not through the url path itself. The router only looks at the path when it's matching a route and it doesn't check what's after the ?. So even if I add a course filter and a year filter, they're just extra data sitting in the request, and my existing route (like /teachers or /books) still matches the same way it always did. That's why in my controller I just read them with $request->query('course') or $request->input('year') instead of writing Route::get('/students/{year}/{course}', ...).

Q2. Suppose you had built both filters as route parameters instead. Describe what the URL for 'year 4 only, no course filter' would have to look like, and why.

Answer: It would have to be something like /games/4/all, with a placeholder for the skipped filter. Route parameters are positional, so I can't leave one out and unlike query strings where I can just drop course= in my case genre=


Q3. Your navigation link stays marked on a detail page and also when a filter is applied. Only one of those two needed a change to your pattern. Say which one, and why the other needed nothing.

Answer: Only the filter-active check needed a change. The detail page one still just matches by route name, same as before. Filter-active isn't connected to a route, it's tied to the query value, so I had to add a separate check like game('year') == 4

Q4. You deleted your old filter method but kept the empty store and update methods, even though none of the three can be reached by a URL. Explain the difference between them.

Answer: The old filter method was dead code, not used anywhere, so I deleted it. store() and update() are empty but intentional and they are resource controller stubs waiting for routes/forms later, not leftovers.
