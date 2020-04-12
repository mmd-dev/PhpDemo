using System;
using System.IO;
using System.Security.Cryptography;
using System.Collections.Generic;
					
public class Program
{	
	public static void Main()
	{	
		Console.WriteLine("Crittare '{0}' produce: {1}", "100.00", EnCrypt("100.00", "f8e032c468994f8cb1aab07010c43a04"));
	}
	
	public static string EnCrypt( string text, string key )
	{	
		RijndaelManaged aes = new RijndaelManaged();
		aes.BlockSize = 0x80;
		aes.KeySize = 0x80;
		aes.Padding = PaddingMode.PKCS7;
		aes.Mode = CipherMode.ECB;

		aes.Key = StringToBytes( key );

		ICryptoTransform encrypt = aes.CreateEncryptor();
		MemoryStream memoryStream = new MemoryStream();
		CryptoStream cryptStream = new CryptoStream( memoryStream, encrypt, CryptoStreamMode.Write );

		byte[] text_bytes = System.Text.Encoding.UTF8.GetBytes( text );

		cryptStream.Write( text_bytes, 0, text_bytes.Length );
		cryptStream.FlushFinalBlock();

		byte[] encrypted = memoryStream.ToArray();
		
		Console.WriteLine(encrypted[0]);
		return ( BitConverter.ToString(encrypted).Replace("-", String.Empty) );
	}

	public static byte[] StringToBytes(string str)
    {
        var bs = new List<byte>();
        for (int i = 0; i < str.Length / 2; i++)
        {
            bs.Add(Convert.ToByte(str.Substring(i*2, 2), 16));
        }
        return bs.ToArray();
    }
}
