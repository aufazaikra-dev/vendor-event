import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                // Sans-serif yang bersih untuk UI dan teks paragraf
                sans: ['Inter', 'Figtree', ...defaultTheme.fontFamily.sans],
                // Serif yang elegan khusus untuk Heading/Judul
                serif: ['"Playfair Display"', 'Lora', ...defaultTheme.fontFamily.serif],
            },
            colors: {
                // Palet Gold/Emas premium untuk aksen, tombol, dan slider
                gold: {
                    50: '#FDFBF7',
                    100: '#FAF5EA',
                    200: '#F1E6CD',
                    300: '#E6D2A8',
                    400: '#DAB87B',
                    500: '#C5A028', // Base Premium Gold
                    600: '#A6821A',
                    700: '#856314',
                    800: '#6A4D16',
                    900: '#5A4116',
                },
                // Palet Champagne untuk background section yang lembut
                champagne: {
                    light: '#FAF8F5',
                    DEFAULT: '#F2EBE3',
                    dark: '#E0D4C3',
                },
                // Hitam arang elegan (tidak terlalu pekat/menyakitkan mata) untuk teks utama
                charcoal: '#1A1A1A',
                //Warna button biru
                brand: {
                    DEFAULT: '#2563eb', // Warna dasar biru (sesuaikan dengan warna brand Anda)
                    strong: '#1d4ed8',  // Warna hover yang lebih gelap
                    medium: '#93c5fd',  // Warna ring saat diklik
                },
            },
        },
    },

    plugins: [forms],
};
