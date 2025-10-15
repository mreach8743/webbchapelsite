import React from 'react';
import MailchimpForm from '../components/MailchimpForm';

const SubscribePage: React.FC = () => {
  return (
    <div className="py-16">
      <div className="container mx-auto px-4">
        <div className="max-w-2xl mx-auto">
          <h1 className="text-3xl md:text-4xl font-bold text-center text-gray-800 mb-12">
            SUBSCRIBE TO OUR MAILING LIST
          </h1>
          
          <MailchimpForm />
        </div>
      </div>
    </div>
  );
};

export default SubscribePage;