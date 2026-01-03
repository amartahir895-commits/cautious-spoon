import { initializeApp } from "https://www.gstatic.com/firebasejs/9.22.0/firebase-app.js";
import { getFirestore, doc, setDoc, getDoc, updateDoc, arrayUnion, arrayRemove } from "https://www.gstatic.com/firebasejs/9.22.0/firebase-firestore.js";
import { getStorage, ref, uploadBytes, getDownloadURL } from "https://www.gstatic.com/firebasejs/9.22.0/firebase-storage.js";

// ⚠️ REPLACE WITH YOUR ACTUAL FIREBASE CONFIG FROM CONSOLE
const firebaseConfig = {
  apiKey: "AIzaSyBnz-02k9Np3Gzqk9KiuuKQWC88HT8WzZs",
  authDomain: "chat-app-e173f.firebaseapp.com",
  databaseURL: "https://chat-app-e173f-default-rtdb.firebaseio.com",
  projectId: "chat-app-e173f",
  storageBucket: "chat-app-e173f.firebasestorage.app",
  messagingSenderId: "649641956064",
  appId: "1:649641956064:web:595d6e9987b609d0c1f685"
};
const app = initializeApp(firebaseConfig);
const db = getFirestore(app);
const storage = getStorage(app);

export { db, storage, doc, setDoc, getDoc, updateDoc, arrayUnion, arrayRemove, ref, uploadBytes, getDownloadURL };
