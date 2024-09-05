<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Smart-Sell</title>
</head>
<body>
    <h5>ආයුබෝවන්, {{ $user->name }}</h5>

    @if($user->role == 'Buyer')
        <p>SmartSell වෙත සාදරයෙන් පිළිගනිමු! ඔබ අපගේ වෙබ් අඩවියට එක්වීම අපට සතුටක්.</p>
        <p> ඔබට කිසියම් ප්‍රශ්න ඇත්නම් අප වෙත දැනුම් දෙන්න.</p>
        <p>සුබ පතමින්,</p>
        <p>SmartSell කණ්ඩායම</p>

    @elseif($user->role == 'Seller')
        <p>SmartSell වෙත සාදරයෙන් පිළිගනිමු! අප ඔබගේ ව්‍යාපාරයට සහාය වීම ගැන අපි සතුටට පත්ව සිටිමු.</p>
        <p>අඔබට කිසියම් ප්‍රශ්න ඇත්නම් අප වෙත දැනුම් දෙන්න.</p>
        <p>සුබ පතමින්,</p>
        <p>SmartSell කණ්ඩායම</p>

    @elseif($user->role == 'Driver')
        <p>SmartSell වෙත සාදරයෙන් පිළිගනිමු! ඔබ අප සමඟ එකතු වීම අපගේ ප්‍රවේශනයට ගෞරවයක්.</p>
        <p>අපගේ වේදිකාව හදාරන්න, ඔබට කිසියම් ප්‍රශ්න ඇත්නම් අප වෙත දැනුම් දෙන්න.</p>
        <p>සුබ පතමින්,</p>
        <p>SmartSell කණ්ඩායම</p>

    @endif
</body>
</html>
