import React, { useEffect } from 'react';

interface CognitoFormProps {
  dataKey: string;
  dataForm: string;
  className?: string;
}

const CognitoForm: React.FC<CognitoFormProps> = ({ dataKey, dataForm, className = '' }) => {
  useEffect(() => {
    // Load Cognito Forms script if not already loaded
    if (!document.querySelector('script[src*="cognitoforms.com"]')) {
      const script = document.createElement('script');
      script.src = 'https://www.cognitoforms.com/f/seamless.js';
      script.setAttribute('data-key', dataKey);
      script.setAttribute('data-form', dataForm);
      document.head.appendChild(script);
    }
  }, [dataKey, dataForm]);

  return (
    <div 
      className={`cognito-form ${className}`}
      data-key={dataKey}
      data-form={dataForm}
    />
  );
};

export default CognitoForm;
