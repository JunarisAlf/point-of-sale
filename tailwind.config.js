export default {
    important: true,
    darkMode: 'class',
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./node_modules/flowbite/**/*.js"
    ],
    theme: {
        extend: {
            colors: {
                gray: {
                    50: '#E6E6EB',
                    100: '#D9DAE0',
                    200: '#C0C2CB',
                    300: '#A7A9B6',
                    400: '#8D91A2',
                    500: '#74788D',
                    600: '#5F6273',
                    700: '#3F414D',
                    800: '#2A2C33',
                    900: '#202126',
                },
                'sider': '#fbfaff',
            }
        }
      },
    plugins: [
        require('flowbite/plugin')
    ],
};
