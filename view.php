<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Toolkit</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-900 min-h-screen text-white font-sans">

    <div class="max-w-md mx-auto relative pb-10">
        <!-- Header Banner -->
        <div class="h-40 bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 rounded-b-[2rem]"></div>

        <!-- Profile Info -->
        <div class="px-6 -mt-16 text-center">
            
            <!-- Dynamic Logo -->
            <div class="relative w-32 h-32 mx-auto mb-4">
                <img id="pageAvatar" src="https://via.placeholder.com/150" class="w-full h-full rounded-full border-4 border-gray-900 object-cover shadow-xl bg-gray-800">
            </div>

            <h1 id="pageTitle" class="text-2xl font-bold">Loading...</h1>
            <p id="pageDesc" class="text-gray-400 text-sm mb-8 mt-1">Please wait...</p>

            <!-- Links -->
            <div id="linksContainer" class="space-y-4"></div>

            <div class="mt-12 text-xs text-gray-600">Powered by LinkBuilder</div>
        </div>
    </div>

    <script type="module">
        import { db, doc, getDoc } from './config.js';

        const params = new URLSearchParams(window.location.search);
        const pageID = params.get('page');

        if(!pageID) window.location.href = 'index.html';

        async function load() {
            try {
                const ref = doc(db, "pages", pageID);
                const snap = await getDoc(ref);

                if(snap.exists()) {
                    const data = snap.data();
                    
                    // Set Title & Description
                    document.title = data.originalName || data.title;
                    document.getElementById('pageTitle').innerText = data.originalName || data.title;
                    document.getElementById('pageDesc').innerText = data.description;
                    
                    // Set Avatar (Logo)
                    if(data.avatar) {
                        document.getElementById('pageAvatar').src = data.avatar;
                    } else {
                        // Default Icon if no logo
                        document.getElementById('pageAvatar').src = "https://cdn-icons-png.flaticon.com/512/149/149071.png";
                    }

                    // Render Links
                    const cont = document.getElementById('linksContainer');
                    data.links.forEach(l => {
                        const a = document.createElement('a');
                        a.href = l.url; a.target = "_blank";
                        a.className = "block bg-gray-800 hover:bg-gray-700 p-4 rounded-xl flex items-center gap-4 transition border border-gray-700 hover:scale-[1.02]";
                        a.innerHTML = `
                            <img src="${l.image || 'https://via.placeholder.com/40'}" class="w-10 h-10 rounded-full object-cover">
                            <span class="font-semibold text-lg flex-1 text-left">${l.name}</span>
                            <i class="fas fa-chevron-right text-gray-500"></i>
                        `;
                        cont.appendChild(a);
                    });
                } else {
                    document.getElementById('pageTitle').innerText = "Not Found";
                }
            } catch(e) { console.error(e); }
        }
        load();
    </script>
</body>
</html>
