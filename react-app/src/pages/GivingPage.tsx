import React from 'react';
import { Globe, Smartphone, MessageSquare, Mail, ExternalLink } from 'lucide-react';

const GivingPage: React.FC = () => {
  const givingMethods = [
    {
      icon: Globe,
      title: "ONLINE",
      description: "Website giving provides a fast, convenient and secure way for you to give one-time gifts or recurring donations by debit card, check card, or credit card. Your gift can also be drawn from your checking account or a savings account. Gifts can be designated for Contribution or Assistance."
    },
    {
      icon: Smartphone,
      title: "MOBILE APP",
      description: "Using the \"Realm-Connect\" Application from your phone you can give one-time gifts or recurring donations by debit card, check card, or credit card. Your gift can also be drawn from your checking account or a savings account. Gifts can be designated for Contribution or Assistance."
    },
    {
      icon: MessageSquare,
      title: "TEXT MESSAGE",
      description: "Text the word WCCCGIVE to 73256. Your one-time gift can be made by debit card, check card, or credit card. Your gift can also be drawn from your checking account or a savings account. Gifts can be designated for Contribution or Assistance."
    },
    {
      icon: Mail,
      title: "BILL PAY",
      description: "You can also set up Webb Chapel in your banking Bill-Pay service. When using this method, please use this mailing address: Webb Chapel Church of Christ, 13425 Webb Chapel Rd., Dallas, Texas 75234, and note if the gift is for the Contribution or Assistance."
    }
  ];

  return (
    <div className="py-16">
      <div className="container mx-auto px-4">
        <h1 className="text-3xl md:text-4xl font-bold text-center text-gray-800 mb-12">
          GIVING METHODS
        </h1>
        
        {/* Giving Methods Grid */}
        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-16">
          {givingMethods.map((method, index) => {
            const IconComponent = method.icon;
            return (
              <div key={index} className="bg-white rounded-lg shadow-lg p-6 hover:shadow-xl transition-shadow">
                <div className="text-center mb-4">
                  <div className="inline-flex items-center justify-center w-16 h-16 bg-church-blue text-white rounded-full mb-4">
                    <IconComponent className="h-8 w-8" />
                  </div>
                  <h3 className="text-xl font-bold text-gray-800">{method.title}</h3>
                </div>
                <p className="text-gray-600 text-sm leading-relaxed">{method.description}</p>
              </div>
            );
          })}
        </div>
        
        {/* Online Giving Link and Scripture */}
        <div className="max-w-6xl mx-auto">
          <div className="grid grid-cols-1 lg:grid-cols-2 gap-8">
            {/* Online Giving Link */}
            <div className="bg-church-blue text-white rounded-lg p-8 text-center">
              <h2 className="text-2xl font-bold mb-4">CLICK HERE TO GIVE ONLINE</h2>
              <a 
                href="https://onrealm.org/WebbChapelChurch/Give" 
                target="_blank" 
                rel="noopener noreferrer"
                className="inline-flex items-center bg-white text-church-blue px-6 py-3 rounded-lg font-semibold hover:bg-gray-100 transition-colors"
              >
                Give Online Now
                <ExternalLink className="ml-2 h-5 w-5" />
              </a>
            </div>
            
            {/* Scripture and Information */}
            <div className="bg-white rounded-lg shadow-lg p-8">
              <h3 className="text-2xl font-bold text-gray-800 mb-6 text-center">
                MATTHEW 25:21
              </h3>
              
              <blockquote className="text-lg italic text-gray-700 mb-6 text-center">
                "His master said to him, 'Well done, good and faithful servant. You have been faithful over a little: I will set you over much. Enter into the joy of your master.'"
              </blockquote>
              
              <div className="prose prose-lg max-w-none text-gray-700">
                <p className="mb-4">
                  Like the servants in the Parable of the Talents, we will be required to give an account of what we have done with everything we have been blessed with. This means our time, our money, and our talents. It is all God's. (Psalm 24:1) And we will give an accounting to the owner who has entrusted all things to us.
                </p>
                
                <div className="bg-gray-50 rounded-lg p-4 mt-6">
                  <h4 className="text-lg font-semibold text-gray-800 mb-2">NEED MORE HELP?</h4>
                  <p className="text-gray-600">
                    If you have questions, call the church office at <strong>(972) 241-3293</strong>.
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
};

export default GivingPage;
